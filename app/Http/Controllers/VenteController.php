<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Chien;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{

    public function index()
    {

        $ventes = Vente::with(['chien','client','user'])
        ->latest()
        ->get();

        return view('ventes.index',compact('ventes'));

    }


    public function create()
    {

        $chiens = Chien::where('statut','disponible')->get();
        $clients = Client::all();

        return view('ventes.create',compact('chiens','clients'));

    }


    public function store(Request $request)
    {

        $data = $request->validate([

            'chien_id'=>'required|exists:chiens,id',
            'client_id'=>'required|exists:clients,id',

            'prix_vente'=>'required|numeric',

            'commission_partenaire'=>'nullable|numeric',

            'commission_cursage'=>'nullable|numeric',

            'date_vente'=>'required|date'

        ]);

        $data['user_id'] = Auth::id();

        Vente::create($data);

        Chien::where('id',$data['chien_id'])
        ->update(['statut'=>'vendu']);

        return redirect()
        ->route('ventes.index')
        ->with('success','Vente enregistrée avec succès');

    }


    public function edit(Vente $vente)
    {

        $chiens = Chien::all();
        $clients = Client::all();

        return view('ventes.edit',compact(
            'vente','chiens','clients'
        ));

    }


    public function show(Vente $vente)
    {
        return view('ventes.show', compact('vente'));
    }


    public function update(Request $request,Vente $vente)
    {

        $data = $request->validate([

            'chien_id'=>'required',
            'client_id'=>'required',

            'prix_vente'=>'required|numeric',

            'commission_partenaire'=>'nullable|numeric',

            'commission_cursage'=>'nullable|numeric',

            'date_vente'=>'required|date'

        ]);

        $vente->update($data);

        return redirect()
        ->route('ventes.index')
        ->with('success','Vente modifiée');

    }


    public function destroy(Vente $vente)
    {

        $vente->delete();

        return back()
        ->with('success','Vente supprimée');

    }

}
