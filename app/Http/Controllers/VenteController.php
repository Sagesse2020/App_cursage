<?php
namespace App\Http\Controllers;
use App\Models\Chien;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chien_id'=>'required|exists:chiens,id',
            'client_id'=>'required|exists:clients,id',
            'prix_vente'=>'required|numeric|min:0'
        ]);

        return DB::transaction(function() use ($request) {
            $chien = Chien::lockForUpdate()->findOrFail($request->chien_id);

            if($chien->statut !== 'disponible'){
                return back()->withErrors('Chien non disponible.');
            }

            $prixVente = $request->prix_vente;
            $commissionPartenaire = 0.00;
            $commissionCursage = $prixVente;

            if($chien->partenaire_id){
                $part = $chien->partenaire;
                $tauxPart = $part->pourcentage_commission ?? 20.00; // % pour partenaire
                $commissionPartenaire = round(($tauxPart/100) * $prixVente, 2);
                $commissionCursage = round($prixVente - $commissionPartenaire, 2);
            }

            $vente = Vente::create([
                'chien_id'=>$chien->id,
                'client_id'=>$request->client_id,
                'user_id'=>auth()->id(),
                'prix_vente'=>$prixVente,
                'commission_partenaire'=>$commissionPartenaire,
                'commission_cursage'=>$commissionCursage,
                'statut_payment'=>'non_paye'
            ]);

            $chien->update(['statut'=>'vendu']);

            Transaction::create([
                'vente_id'=>$vente->id,
                'type'=>'paiement_client',
                'montant'=>$prixVente,
                'destinataire'=>'CURSAGE (compte)',
                'notes'=>'Paiement enregistré, à répartir'
            ]);

            return redirect()->route('ventes.show', $vente->id)->with('success','Vente enregistrée.');
        });
    }

    public function show(Vente $vente){
        return view('ventes.show', compact('vente'));
    }

    public function index(){
        $query = Vente::with('chien.race','client','user');
        if(auth()->user()->role === 'partner'){
            $part = auth()->user()->partenaire;
            $query->whereHas('chien', function($q) use ($part){ $q->where('partenaire_id', $part->id); });
        }
        $ventes = $query->orderBy('date_vente','desc')->paginate(20);
        return view('ventes.index', compact('ventes'));
    }
}
