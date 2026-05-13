<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProduitController extends Controller
{
       use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();

        // ADMIN 3 voit tout
        if ($user->niveau_admin == 3) {
            $produits = Produit::with('categorie', 'user')
                ->latest()
                ->paginate(10);
        }
        // ADMIN 2 voit tout mais lecture logique
        elseif ($user->niveau_admin == 2) {
            $produits = Produit::with('categorie', 'user')
                ->latest()
                ->paginate(10);
        }
        // PARTENAIRES voient seulement leurs produits
        else {
            $produits = Produit::with('categorie', 'user')
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        }

        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $produits = Produit::all();
        return view('produits.create', compact('categories','produits'));
    }
     
public function accueil()
{
    $produits = Produit::with('categorie', 'user')->latest()->get();

    return view('produits.accueil', compact('produits'));
}
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'categorie_id' => 'required',
            'prix_achat' => 'required',
            'prix_vente' => 'required',
            'stock' => 'nullable',
            'photo' => 'nullable'
        ]);

        $data['user_id'] = Auth::id();

        Produit::create($data);

        return redirect()->route('produits.index')
            ->with('success', 'Produit créé avec succès');
    }

    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $this->authorize('update', $produit);

        $categories = Categorie::all();

        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $this->authorize('update', $produit);

        $data = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'categorie_id' => 'required',
            'prix_achat' => 'required',
            'prix_vente' => 'required',
            'stock' => 'nullable',
            'photo' => 'nullable'
        ]);

        $produit->update($data);

        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour');
    }
}