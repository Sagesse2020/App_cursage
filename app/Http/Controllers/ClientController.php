<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
       public function index()
    {
        $clients = Client::latest()->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'email'=>'required|email|unique:clients',
            'telephone'=>'required|unique:clients',
            'adresse'=>'required',
            'password'=>'required|min:6'
        ]);

        Client::create([
            'nom'=>$request->nom,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('clients.index')->with('success','Client ajouté');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {

        $request->validate([
            'nom'=>'required',
            'email'=>'required|email|unique:clients,email,'.$client->id,
            'telephone'=>'required|unique:clients,telephone,'.$client->id,
            'adresse'=>'required'
        ]);

        $client->update([
            'nom'=>$request->nom,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse
        ]);

        if($request->password){
            $client->update([
                'password'=>Hash::make($request->password)
            ]);
        }

        return redirect()->route('clients.index')->with('success','Client modifié');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success','Client supprimé');
    }

    public function rechercher()
    {

    }
}
