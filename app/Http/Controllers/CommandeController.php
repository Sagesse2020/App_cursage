<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
      public function index()
    {
        $commandes = Commande::with('user')->latest()->get();
        return view('commandes.index', compact('commandes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_nom' => 'required',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric',
            'mode_paiement' => 'required'
        ]);

        $total = $request->quantite * $request->prix_unitaire;

         Commande::create([
            'user_id' => Auth::user(),
            'produit_nom' => $request->produit_nom,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'montant_total' => $total,
            'mode_paiement' => $request->mode_paiement,
        ]);

        return back()->with('success','Commande enregistrée');
    }

    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    public function updateStatus(Request $request, Commande $commande)
    {
        $commande->update([
            'statut' => $request->statut
        ]);

        return back();
    }
}
