<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Produit;

class ProduitController extends Controller
{public function index()
{
$produits = Produit::with('categorie')->latest()->paginate(10);

return view('produits.index',compact('produits'));
}


public function create()
{
$categories = Categorie::all();

return view('produits.create',compact('categories'));
}


public function store(Request $request)
{

$data = $request->validate([

'nom'=>'required',

'description'=>'nullable',

'categorie_id'=>'required',

'prix_achat'=>'required',

'prix_vente'=>'required',

'stock'=>'nullable'

]);

Produit::create($data);

return redirect()->route('produits.index');

}


public function edit(Produit $produit)
{

$categories = Categorie::all();

return view('produits.edit',compact('produit','categories'));

}


public function update(Request $request,Produit $produit)
{

$data = $request->validate([

'nom'=>'required',

'description'=>'nullable',

'categorie_id'=>'required',

'prix_achat'=>'required',

'prix_vente'=>'required',

'stock'=>'nullable'

]);

$produit->update($data);

return redirect()->route('produits.index');

}

}
