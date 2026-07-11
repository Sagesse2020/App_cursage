<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Partenaire;
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

    $categories = Categorie::all();  

$query = Produit::with(['categorie', 'user', 'partenaire']);

if ($user->niveau_admin == 3) {

    // Tout voir

} elseif (!$user->partenaire_id) {

    // Employé CURSAGE
    $query->whereNull('partenaire_id');

} else {

    $partenaire = $user->partenaire;

    if ($partenaire->type_partenaire == 'vendeur') {

        $query->where('partenaire_id', $partenaire->id);

    } elseif ($partenaire->type_partenaire == 'apporteur_affaires') {

        $query->whereNull('partenaire_id');

    }

}

        $produits = $query->paginate(12);

        return view('produits.index', compact('produits','categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Categorie::all();
        $partenaires = Partenaire::orderBy('nom')->get();

        return view('produits.create', compact('categories','partenaires'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'partenaire_id' => 'nullable|exists:partenaires,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

         $user = Auth::user();

         $data['user_id'] = $user->id;

         if($user->role == 'admin' && $user->niveau_admin >= 2){

    // Admin CURSAGE peut choisir
    $data['partenaire_id'] = $request->partenaire_id;

}else{

    // Partenaire normal
    $data['partenaire_id'] = $user->partenaire_id;

}

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
    $produit->load([
        'categorie',
        'user',
        'partenaire'
    ]);

    return view(
        'produits.show',
        compact('produit')
    );
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
        $partenaires = Partenaire::all();

        return view('produits.edit', compact('produit', 'categories','partenaires'));
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
            'partenaire_id' => 'nullable|exists:partenaires,id',
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