<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\Vente;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Achat;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index(Request $request)
    {
        $query = Paiement::with([
            'reservation',
            'vente',
            'commande',
            'facture',
            'achat',
            'user'
        ]);

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('montant', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%')
                  ->orWhere('mode_paiement', 'like', '%' . $request->search . '%')
                  ->orWhere('statut', 'like', '%' . $request->search . '%');

            });
        }

        $user = auth()->user();

        if ($user->niveau_admin != 3) {
            $query->where('user_id', $user->id);
        }

        $paiements = $query->latest()->paginate(10);

        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        return view('paiements.create', [

            'reservations' => Reservation::all(),
            'ventes' => Vente::all(),
            'commandes' => Commande::all(),
            'factures' => Facture::all(),
            'achats' => Achat::all(),

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'montant' => 'required|numeric|min:1',
            'type' => 'required',
            'mode_paiement' => 'required',
            'statut' => 'required',
            'date_paiement' => 'required|date',

        ]);

        if (
            !$request->reservation_id &&
            !$request->vente_id &&
            !$request->commande_id &&
            !$request->facture_id &&
            !$request->achat_id
        ) {
            return back()
                ->withErrors([
                    'document' => 'Veuillez sélectionner au moins un document.'
                ])
                ->withInput();
        }

        $paiement = Paiement::create([

            'reservation_id' => $request->reservation_id,
            'vente_id' => $request->vente_id,
            'commande_id' => $request->commande_id,
            'facture_id' => $request->facture_id,
            'achat_id' => $request->achat_id,

            'montant' => $request->montant,
            'type' => $request->type,
            'mode_paiement' => $request->mode_paiement,
            'statut' => $request->statut,
            'date_paiement' => $request->date_paiement,
            'observation' => $request->observation,

            'user_id' => auth()->id()

        ]);

        NotificationService::create(
            'Nouveau paiement',
            "Paiement de {$paiement->montant} FCFA enregistré",
            'success',
            'paiement',
            auth()->id()
        );

        return redirect()
            ->route('paiements.index')
            ->with('success', 'Paiement créé avec succès.');
    }

    public function show(Paiement $paiement)
    {
        return view('paiements.show', compact('paiement'));
    }

    public function edit(Paiement $paiement)
    {
        return view('paiements.edit', [

            'paiement' => $paiement,
            'reservations' => Reservation::all(),
            'ventes' => Vente::all(),
            'commandes' => Commande::all(),
            'factures' => Facture::all(),
            'achats' => Achat::all(),

        ]);
    }

    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([

            'montant' => 'required|numeric|min:1',
            'type' => 'required',
            'mode_paiement' => 'required',
            'statut' => 'required',
            'date_paiement' => 'required|date',

        ]);

        $paiement->update($request->all());

        NotificationService::create(
            'Paiement modifié',
            "Le paiement #{$paiement->id} a été modifié",
            'warning',
            'paiement',
            auth()->id()
        );

        return redirect()
            ->route('paiements.index')
            ->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy(Paiement $paiement)
    {
        $montant = $paiement->montant;

        $paiement->delete();

        NotificationService::create(
            'Paiement supprimé',
            "Le paiement de {$montant} FCFA a été supprimé",
            'danger',
            'paiement',
            auth()->id()
        );

        return redirect()
            ->route('paiements.index')
            ->with('success', 'Paiement supprimé.');
    }
}