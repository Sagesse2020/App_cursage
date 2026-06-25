<?php

namespace App\Http\Controllers;

use App\Models\PaiementCommission;
use App\Models\PartenaireCommission;
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
        ->latest()
        ->paginate(12);

        return view(
            'paiement_commissions.index',
            compact('paiements')
        );
    }

    public function create()
    {
        $commissions =
            PartenaireCommission::with('partenaire')
            ->get();

        return view(
            'paiement_commissions.create',
            compact('commissions')
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