<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\PartenaireCommission;
use App\Models\Produit;
use App\Models\Chien;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartenaireCommissionController extends Controller
{
    public function index()
    {
        $commissions = PartenaireCommission::with([
            'partenaire',
            'produit',
            'chien'
        ])
        ->latest()
        ->paginate(12);

        return view(
            'partenaire_commissions.index',
            compact('commissions')
        );
    }

    public function create()
    {
        $partenaires = Partenaire::orderBy('nom')->get();

        $produits = Produit::orderBy('nom')->get();

        $chiens = Chien::orderBy('nom')->get();

        return view(
            'partenaire_commissions.create',
            compact(
                'partenaires',
                'produits',
                'chiens'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'partenaire_id' => 'required|exists:partenaires,id',
            'pourcentage' => 'required|numeric|min:0|max:100',
            'date_debut' => 'required|date'
        ]);

        $commission = PartenaireCommission::create([

            'partenaire_id' => $request->partenaire_id,
            'produit_id' => $request->produit_id,
            'chien_id' => $request->chien_id,
            'pourcentage' => $request->pourcentage,
            'montant_fixe' => $request->montant_fixe,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,

        ]);

        NotificationService::create(
            'Nouvelle commission',
            "Une commission de {$commission->pourcentage}% a été créée.",
            'success',
            'commission',
            Auth::id()
        );

        return redirect()
            ->route('partenaire_commissions.index')
            ->with(
                'success',
                'Commission enregistrée.'
            );
    }

    public function show(
        PartenaireCommission $partenaireCommission
    )
    {
        return view(
            'partenaire_commissions.show',
            compact('partenaireCommission')
        );
    }

    public function edit(
        PartenaireCommission $partenaireCommission
    )
    {
        $partenaires = Partenaire::orderBy('nom')->get();

        $produits = Produit::orderBy('nom')->get();

        $chiens = Chien::orderBy('nom')->get();

        return view(
            'partenaire_commissions.edit',
            compact(
                'partenaireCommission',
                'partenaires',
                'produits',
                'chiens'
            )
        );
    }

    public function update(
        Request $request,
        PartenaireCommission $partenaireCommission
    )
    {
        $ancienPourcentage =
            $partenaireCommission->pourcentage;

        $request->validate([
            'partenaire_id' => 'required|exists:partenaires,id',
            'pourcentage' => 'required|numeric|min:0|max:100',
            'date_debut' => 'required|date'
        ]);

        $partenaireCommission->update([

            'partenaire_id' => $request->partenaire_id,
            'produit_id' => $request->produit_id,
            'chien_id' => $request->chien_id,
            'pourcentage' => $request->pourcentage,
            'montant_fixe' => $request->montant_fixe,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,

        ]);

        NotificationService::create(
            'Commission modifiée',
            "La commission est passée de {$ancienPourcentage}% à {$partenaireCommission->pourcentage}%.",
            'warning',
            'commission',
            Auth::id()
        );

        return redirect()
            ->route('partenaire_commissions.index')
            ->with(
                'success',
                'Commission modifiée.'
            );
    }

    public function destroy( PartenaireCommission $partenaireCommission)
    {
        $pourcentage = $partenaireCommission->pourcentage;

        $partenaireCommission->delete();

        NotificationService::create(
            'Commission supprimée',
            "Une commission de {$pourcentage}% a été supprimée.",
            'danger',
            'commission',
            Auth::id()
        );

        return redirect()
            ->route('partenaire_commissions.index')
            ->with(
                'success',
                'Commission supprimée.'
            );
    }
}