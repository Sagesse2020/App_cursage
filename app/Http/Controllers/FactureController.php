<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Vente;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Liste des factures
     */
    public function index(Request $request)
    {
        $query = Facture::with(['client','vente']);

        if ($request->filled('numero')) {
            $query->where('numero', 'like', '%' . $request->numero . '%');
        }

        if ($request->filled('client')) {
            $query->where('client_id', $request->client);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $factures = $query->latest()->paginate(10);

        $clients = Client::orderBy('nom')->get();

        return view(
            'factures.index',
            compact(
                'factures',
                'clients'
            )
        );
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        $clients = Client::orderBy('nom')->get();

        $ventes = Vente::latest()->get();

        return view(
            'factures.create',
            compact(
                'clients',
                'ventes'
            )
        );
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'client_id' => 'required|exists:clients,id',
            'vente_id'  => 'nullable|exists:ventes,id',
            'date'      => 'required|date',
            'total'     => 'required|numeric|min:0',
            'statut'    => 'required|string',
            'type'      => 'nullable|string'

        ]);

        $data['numero'] =
            'FAC-' .
            date('Y') .
            '-' .
            strtoupper(substr(uniqid(), -5));

        $facture = Facture::create($data);

        NotificationService::create(
            'Nouvelle facture',
            "Une facture N° {$facture->numero} a été créée.",
            'success',
            'facture',
            auth()->id()
        );

        if ($facture->statut === 'impayée') {

            NotificationService::create(
                'Facture impayée',
                "La facture N° {$facture->numero} est impayée.",
                'danger',
                'finance',
                auth()->id()
            );
        }

        return redirect()
            ->route('factures.index')
            ->with(
                'success',
                'Facture créée avec succès.'
            );
    }

    /**
     * Détail
     */
    public function show(Facture $facture)
    {
        $facture->load(
            'client',
            'vente'
        );

        return view(
            'factures.show',
            compact('facture')
        );
    }

    /**
     * Formulaire modification
     */
    public function edit(Facture $facture)
    {
        $clients = Client::orderBy('nom')->get();

        $ventes = Vente::latest()->get();

        return view(
            'factures.edit',
            compact(
                'facture',
                'clients',
                'ventes'
            )
        );
    }

    /**
     * Mise à jour
     */
    public function update(
        Request $request,
        Facture $facture
    )
    {
        $data = $request->validate([

            'client_id' => 'required|exists:clients,id',
            'vente_id'  => 'nullable|exists:ventes,id',
            'date'      => 'required|date',
            'total'     => 'required|numeric|min:0',
            'statut'    => 'required|string',
            'type'      => 'nullable|string'

        ]);

        $ancienStatut = $facture->statut;

        $facture->update($data);

        NotificationService::create(
            'Facture modifiée',
            "La facture N° {$facture->numero} a été modifiée.",
            'warning',
            'facture',
            auth()->id()
        );

        if (
            $ancienStatut != 'impayée'
            &&
            $facture->statut == 'impayée'
        ) {

            NotificationService::create(
                'Facture impayée',
                "La facture N° {$facture->numero} est désormais impayée.",
                'danger',
                'finance',
                auth()->id()
            );
        }

        if (
            $ancienStatut != 'payée'
            &&
            $facture->statut == 'payée'
        ) {

            NotificationService::create(
                'Paiement reçu',
                "La facture N° {$facture->numero} a été réglée.",
                'success',
                'finance',
                auth()->id()
            );
        }

        return redirect()
            ->route('factures.index')
            ->with(
                'success',
                'Facture mise à jour avec succès.'
            );
    }

    /**
     * Suppression
     */
    public function destroy(Facture $facture)
    {
        $numero = $facture->numero;

        $facture->delete();

        NotificationService::create(
            'Facture supprimée',
            "La facture N° {$numero} a été supprimée.",
            'danger',
            'facture',
            auth()->id()
        );

        return back()->with(
            'success',
            'Facture supprimée avec succès.'
        );
    }

    /**
     * Impression
     */
    public function print(Facture $facture)
    {
        $facture->load(
            'client',
            'vente'
        );

        return view(
            'factures.print',
            compact('facture')
        );
    }
}
