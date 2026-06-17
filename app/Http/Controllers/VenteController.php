<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Chien;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\NotificationService;
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

    $vente = Vente::create($data);

    Chien::where(
        'id',
        $data['chien_id']
    )->update([
        'statut'=>'vendu'
    ]);

    $vente->load(
        'chien',
        'client'
    );

    NotificationService::create(
        'Nouvelle vente',
        "Le chien {$vente->chien->nom} a été vendu à {$vente->client->nom}.",
        'success',
        'vente',
        auth()->id()
    );

    NotificationService::create(
        'Chien vendu',
        "Le statut du chien {$vente->chien->nom} est désormais vendu.",
        'info',
        'chien',
        auth()->id()
    );

    return redirect()
        ->route('ventes.index')
        ->with(
            'success',
            'Vente enregistrée avec succès'
        );
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

    $vente->load(
        'chien',
        'client'
    );

    NotificationService::create(
        'Vente modifiée',
        "La vente #{$vente->id} du chien {$vente->chien->nom} a été modifiée.",
        'warning',
        'vente',
        auth()->id()
    );

    return redirect()
        ->route('ventes.index')
        ->with(
            'success',
            'Vente modifiée'
        );
     }

      public function destroy(Vente $vente)
{
    $vente->load('chien');

    $nomChien = $vente->chien->nom;

    $vente->delete();

    NotificationService::create(
        'Vente supprimée',
        "La vente du chien {$nomChien} a été supprimée.",
        'danger',
        'vente',
        auth()->id()
    );

    NotificationService::create(
        'Vérification requise',
        "Vérifiez le statut du chien {$nomChien} après suppression de la vente.",
        'warning',
        'chien',
        auth()->id()
    );

    return back()
        ->with(
            'success',
            'Vente supprimée'
        );
    }

}
