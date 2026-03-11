<?php

// app/Http/Controllers/EvenementController.php
namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index() {
       $evenements = Evenement::orderBy('created_at', 'desc')->get();
    return view('evenements.index', compact('evenements'));
    }

    public function create() {
        return view('evenements.create');
    }

    public function store(Request $request) {
        $request->validate([
            'titre'=>'required|string|max:255',
            'description'=>'nullable|string',
            'date'=>'required|date',
            'image'=>'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('evenements','public');
        }

        Evenement::create([
            'titre'=>$request->titre,
            'description'=>$request->description,
            'date'=>$request->date,
            'image'=>$path,
        ]);

        return redirect()->route('evenements.index')->with('success','Événement ajouté.');
    }

    public function show(Evenement $evenement){
        return view('evenements.show', compact('evenement'));
    }

    public function edit(Evenement $evenement){
        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement){
        $request->validate([
            'titre'=>'required|string|max:255',
            'description'=>'nullable|string',
            'date'=>'required|date',
            'image'=>'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if($request->hasFile('image')){
            $evenement->image = $request->file('image')->store('evenements','public');
        }

        $evenement->update([
            'titre'=>$request->titre,
            'description'=>$request->description,
            'date'=>$request->date,
            'image'=>$evenement->image,
        ]);

        return redirect()->route('evenements.index')->with('success','Événement modifié.');
    }

    public function destroy(Evenement $evenement){
        $evenement->delete();
        return redirect()->route('evenements.index')->with('success','Événement supprimé.');
    }
}
