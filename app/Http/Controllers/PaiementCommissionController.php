<?php

namespace App\Http\Controllers;

use App\Models\PaiementCommission;
use App\Models\PartenaireCommission;
use App\Models\Partenaire;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementCommissionController extends Controller
{
    public function index()
    {
       $paiements = PaiementCommission::with([
    'commission.partenaire'
])

->when(request('search'), function($q){

    $q->whereHas(
        'commission.partenaire',
        function($query){

            $query->where(
                'nom',
                'like',
                '%'.request('search').'%'
            );

        }
    );

})

->when(request('statut'), function($q){

    $q->where(
        'statut',
        request('statut')
    );

})

->when(request('mode_paiement'), function($q){

    $q->where(
        'mode_paiement',
        request('mode_paiement')
    );

})

->latest()
->paginate(12)
->withQueryString();

$totalPaye =
PaiementCommission::where(
    'statut',
    'paye'
)->sum('montant');

$totalAttente =
PaiementCommission::where(
    'statut',
    'en_attente'
)->sum('montant');

return view(
    'paiement_commissions.index',
    compact(
        'paiements',
        'totalPaye',
        'totalAttente'
    )
);
    }

    public function create()
    {
        $commissions =
            PartenaireCommission::with('partenaire')
            ->get();
         $partenaires = Partenaire::all();    

        return view(
            'paiement_commissions.create',
            compact('commissions','partenaires')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'partenaire_commission_id'
                => 'required|exists:partenaire_commissions,id',

            'montant'
                => 'required|numeric|min:0',

            'date_paiement'
                => 'required|date',

            'mode_paiement'
                => 'required'

        ]);

        $paiement = PaiementCommission::create([
            'partenaire_id'
                => $request->partenaire_id,

            'partenaire_commission_id'
                => $request->partenaire_commission_id,

            'montant'
                => $request->montant,

            'date_paiement'
                => $request->date_paiement,

            'mode_paiement'
                => $request->mode_paiement,

            'statut'
                => $request->statut,

            'reference'
                => $request->reference,

            'observation'
                => $request->observation,

            'user_id'
                => Auth::id()

        ]);

        NotificationService::create(
            'Paiement commission',
            "Paiement commission de {$paiement->montant} FCFA enregistré.",
            'success',
            'paiement_commission',
            Auth::id()
        );

        return redirect()
            ->route('paiement_commissions.index')
            ->with(
                'success',
                'Paiement enregistré.'
            );
    }

    public function show(
        PaiementCommission $paiementCommission
    )
    {
        return view(
            'paiement_commissions.show',
            compact('paiementCommission')
        );
    }

    public function edit(
        PaiementCommission $paiementCommission
    )
    {
        $commissions =
            PartenaireCommission::with('partenaire')
            ->get();

        return view(
            'paiement_commissions.edit',
            compact(
                'paiementCommission',
                'commissions'
            )
        );
    }

    public function update(
        Request $request,
        PaiementCommission $paiementCommission
    )
    {
        $request->validate([

            'montant'
                => 'required|numeric|min:0',

            'date_paiement'
                => 'required|date'
        ]);

        $ancienMontant =
            $paiementCommission->montant;

        $paiementCommission->update(
            $request->all()
        );

        NotificationService::create(
            'Paiement modifié',
            "Paiement modifié de {$ancienMontant} FCFA vers {$paiementCommission->montant} FCFA.",
            'warning',
            'paiement_commission',
            Auth::id()
        );

        return redirect()
            ->route('paiement_commissions.index')
            ->with(
                'success',
                'Paiement modifié.'
            );
    }

    public function destroy(
        PaiementCommission $paiementCommission
    )
    {
        $montant =
            $paiementCommission->montant;

        $paiementCommission->delete();

        NotificationService::create(
            'Paiement supprimé',
            "Paiement commission de {$montant} FCFA supprimé.",
            'danger',
            'paiement_commission',
            Auth::id()
        );

        return redirect()
            ->route('paiement_commissions.index')
            ->with(
                'success',
                'Paiement supprimé.'
            );
    }
}