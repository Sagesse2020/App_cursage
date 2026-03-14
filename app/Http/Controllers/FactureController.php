<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Vente;
use Illuminate\Http\Request;

class FactureController extends Controller
{

    public function index()
    {
        $factures = Facture::with('client','vente')
                    ->latest()
                    ->paginate(10);

        return view('factures.index',compact('factures'));
    }

    public function create()
    {
        $clients = Client::all();
        $ventes = Vente::all();

        return view('factures.create',compact('clients','ventes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'client_id'=>'required|exists:clients,id',
            'vente_id'=>'nullable|exists:ventes,id',
            'date'=>'required|date',
            'total'=>'required|numeric',
            'statut'=>'required',
            'type'=>'nullable|string'

        ]);

        // génération automatique numéro facture
        $data['numero'] = 'FAC-' . date('Y') . '-' . rand(1000,9999);

        Facture::create($data);

        return redirect()
        ->route('factures.index')
        ->with('success','Facture créée');
    }


    public function show(Facture $facture)
    {
        return view('factures.show',compact('facture'));
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();

        return back()->with('success','Facture supprimée');
    }

    public function print(Facture $facture)
{
    $facture->load('client','vente');

    return view('factures.print',compact('facture'));
}

}
