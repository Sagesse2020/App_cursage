<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    /**
     * Liste des services
     */
    public function index(Request $request)
{
    $query = Service::query();

    if($request->filled('search'))
    {
        $query->where('nom','like',
        '%'.$request->search.'%');
    }

    if($request->filled('statut'))
    {
        $query->where(
            'statut',
            $request->statut
        );
    }

    $services = $query
        ->latest()
        ->paginate(10);

    return view(
        'services.index',
        compact('services')
    );
}


    /**
     * Formulaire création service
     */
    public function create()
    {
        return view('services.create');
    }


    /**
     * Enregistrer service
     */
    public function store(Request $request)
    {

        $data = $request->validate([

            'nom'=>'required|string|max:255',

            'description'=>'required|string',

            'prix_vente'=>'required|numeric|min:0',

            'statut'=>'required|in:en_cours,termine'

        ]);

        Service::create($data);

        return redirect()
        ->route('services.index')
        ->with('success','Service enregistré avec succès');
    }

      public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }


    /**
     * Formulaire modification
     */
    public function edit(Service $service)
    {
        return view('services.edit',compact('service'));
    }


    /**
     * Mise à jour service
     */
    public function update(Request $request, Service $service)
    {

        $data = $request->validate([

            'nom'=>'required|string|max:255',

            'description'=>'required|string',

            'prix_vente'=>'required|numeric|min:0',

            'statut'=>'required|in:en_cours,termine'

        ]);

        $service->update($data);

        return redirect()
        ->route('services.index')
        ->with('success','Service modifié avec succès');
    }


    /**
     * Supprimer service
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return back()
        ->with('success','Service supprimé');
    }

}
