<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    use AuthorizesRequests;

    /*
    |--------------------------------------------------------------------------
    | LISTE PRODUITS (INDEX)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $user = Auth::user();

        $query = Produit::with(['categorie', 'user'])
            ->latest();

        // 🔐 Filtrage selon rôle
        if ($user->niveau_admin < 3) {
            $query->where('user_id', $user->id);
        }

        $produits = $query->paginate(12);

        return view('produits.index', compact('produits'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Categorie::all();

        return view('produits.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data['user_id'] = Auth::id();

        // 📸 upload image propre
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produits', 'public');
        }

        $produit = Produit::create($data);

        return redirect()
            ->route('produits.index')
            ->with('success', 'Produit créé avec succès');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show(Produit $produit)
    {
        $produit->load(['categorie', 'user']);

        return view('produits.show', compact('produit'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Produit $produit)
    {
        $this->authorize('update', $produit);

        $categories = Categorie::all();

        return view('produits.edit', compact('produit', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Produit $produit)
    {
        $this->authorize('update', $produit);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // 📸 update image propre
        if ($request->hasFile('photo')) {

            // supprimer ancienne image si existe
            if ($produit->photo) {
                Storage::disk('public')->delete($produit->photo);
            }

            $data['photo'] = $request->file('photo')->store('produits', 'public');
        }

        $produit->update($data);

        return redirect()
            ->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE (IMPORTANT POUR OBSERVER)
    |--------------------------------------------------------------------------
    */
    public function destroy(Produit $produit)
    {
        $this->authorize('delete', $produit);

        if ($produit->photo) {
            Storage::disk('public')->delete($produit->photo);
        }

        $produit->delete();

        return redirect()
            ->route('produits.index')
            ->with('success', 'Produit supprimé');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCUEIL PUBLIC
    |--------------------------------------------------------------------------
    */
    public function accueil()
    {
        $produits = Produit::with(['categorie', 'user'])
            ->latest()
            ->get();

        return view('produits.accueil', compact('produits'));
    }

    /*
    |--------------------------------------------------------------------------
    | RAPPORT PDF
    |--------------------------------------------------------------------------
    */
    public function rapportProduits()
    {
        $produits = Produit::with(['categorie', 'user'])->get();

        $html = view('pdf.produits', compact('produits'))->render();

        return response($html)
            ->header('Content-Type', 'application/pdf');
    }
}