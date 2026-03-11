<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Vente;
use Illuminate\Http\Request;

class FactureController extends Controller
{

public function index()
{

$factures = Facture::with('vente')->latest()->get();

return view('factures.index',compact('factures'));

}

public function create()
{

$ventes = Vente::all();

return view('factures.create',compact('ventes'));

}

public function store(Request $request)
{

$data = $request->validate([

'vente_id'=>'required',
'type'=>'required'

]);

Facture::create($data);

return redirect()->route('factures.index');

}

public function edit(Facture $facture)
{

$ventes = Vente::all();

return view('factures.edit',compact('facture','ventes'));

}

public function update(Request $request, Facture $facture)
{

$facture->update($request->all());

return redirect()->route('factures.index');

}

public function destroy(Facture $facture)
{

$facture->delete();

return back();

}

}
