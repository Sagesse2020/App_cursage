<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    // ================= CREATE =================

    public function create()
    {
        $produits = Produit::all();
        $commandes = Commande::all();
        return view('commandes.create', compact('commandes','produits'));
    }

    // ================= INDEX =================

    public function index()
    {
        $commandes = Commande::with('user')
            ->latest()
            ->get();

        return view('commandes.index', compact('commandes'));
    }

    // ================= STORE =================

   public function store(Request $request)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|integer|min:1',
        'mode_paiement' => 'required'
    ]);

    $produit = Produit::findOrFail($request->produit_id);

    $total = $produit->prix_vente * $request->quantite;

    Commande::create([
        'user_id' => Auth::id(),
        'produit_nom' => $produit->nom,
        'quantite' => $request->quantite,
        'prix_unitaire' => $produit->prix_vente,
        'montant_total' => $total,
        'mode_paiement' => $request->mode_paiement,
    ]);

    return redirect()->route('commandes.index')
        ->with('success', 'Commande enregistrée avec succès');
}
    // ================= SHOW =================

    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    // ================= UPDATE STATUS =================

    public function updateStatus(
        Request $request,
        Commande $commande
    ) {

        $commande->update([

            'statut' => $request->statut

        ]);

        return back();
    }
}