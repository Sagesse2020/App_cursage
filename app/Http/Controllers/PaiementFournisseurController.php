<?php

namespace App\Http\Controllers;

use App\Models\PaiementFournisseur;
use App\Models\Fournisseur;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementFournisseurController extends Controller
{
    public function index()
    {
        $paiements = PaiementFournisseur::with([
            'fournisseur',
            'user'
        ])
        ->latest()
        ->paginate(12);

        return view(
            'paiement_fournisseurs.index',
            compact('paiements')
        );
    }

    public function create()
    {
        $fournisseurs =
        Fournisseur::orderBy('nom')
        ->get();

        return view(
            'paiement_fournisseurs.create',
            compact('fournisseurs')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'fournisseur_id'
            => 'required|exists:fournisseurs,id',

            'montant'
            => 'required|numeric|min:1',

            'date_paiement'
            => 'required|date',

            'mode_paiement'
            => 'required'
        ]);

        $paiement =
        PaiementFournisseur::create([

            'fournisseur_id'
            => $request->fournisseur_id,

            'montant'
            => $request->montant,

            'date_paiement'
            => $request->date_paiement,

            'mode_paiement'
            => $request->mode_paiement,

            'statut'
            => $request->statut,

            'observation'
            => $request->observation,

            'user_id'
            => Auth::id()

        ]);

        NotificationService::create(

            'Paiement fournisseur',

            'Un paiement fournisseur de '
            . number_format(
                $paiement->montant,
                0,
                ',',
                ' '
            )
            . ' FCFA a été enregistré.',

            'success',

            'finance',

            Auth::id()

        );

        return redirect()
            ->route(
                'paiement_fournisseurs.index'
            )
            ->with(
                'success',
                'Paiement enregistré.'
            );
    }

    public function show(
        PaiementFournisseur
        $paiementFournisseur
    )
    {
        return view(
            'paiement_fournisseurs.show',
            compact(
                'paiementFournisseur'
            )
        );
    }

    public function edit(
        PaiementFournisseur
        $paiementFournisseur
    )
    {
        $fournisseurs =
        Fournisseur::orderBy('nom')
        ->get();

        return view(
            'paiement_fournisseurs.edit',
            compact(
                'paiementFournisseur',
                'fournisseurs'
            )
        );
    }

    public function update(
        Request $request,
        PaiementFournisseur
        $paiementFournisseur
    )
    {
        $ancienMontant =
        $paiementFournisseur->montant;

        $paiementFournisseur->update([

            'fournisseur_id'
            => $request->fournisseur_id,

            'montant'
            => $request->montant,

            'date_paiement'
            => $request->date_paiement,

            'mode_paiement'
            => $request->mode_paiement,

            'statut'
            => $request->statut,

            'observation'
            => $request->observation

        ]);

        NotificationService::create(

            'Paiement modifié',

            "Paiement fournisseur modifié de "
            .$ancienMontant.
            " FCFA vers "
            .$request->montant.
            " FCFA.",

            'warning',

            'finance',

            Auth::id()

        );

        return redirect()
            ->route(
                'paiement_fournisseurs.index'
            )
            ->with(
                'success',
                'Paiement modifié.'
            );
    }

    public function destroy(
        PaiementFournisseur
        $paiementFournisseur
    )
    {
        $montant =
        $paiementFournisseur->montant;

        $paiementFournisseur->delete();

        NotificationService::create(

            'Paiement supprimé',

            "Paiement fournisseur de "
            .$montant.
            " FCFA supprimé.",

            'danger',

            'finance',

            Auth::id()

        );

        return redirect()
            ->route(
                'paiement_fournisseurs.index'
            )
            ->with(
                'success',
                'Paiement supprimé.'
            );
    }
}