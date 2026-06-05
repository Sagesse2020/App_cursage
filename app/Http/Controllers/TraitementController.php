<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraitementController extends Controller
{
    public function index()
    {
        $traitements = Traitement::with(['chien','user'])->latest()->paginate(10);
        return view('traitements.index', compact('traitements'));
    }

    public function create()
    {
        $chiens = Chien::all();
        return view('traitements.create', compact('chiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chien_id' => 'required',
            'nom_traitement' => 'required',
            'date_debut' => 'required|date',
            'cout' => 'required|numeric',
        ]);

        Traitement::create([
            'chien_id' => $request->chien_id,
            'nom_traitement' => $request->nom_traitement,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'cout' => $request->cout,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('traitements.index')
            ->with('success','Traitement ajouté avec succès');
    }

    public function edit(Traitement $traitement)
    {
        $chiens = Chien::all();
        return view('traitements.edit', compact('traitement','chiens'));
    }

    public function update(Request $request, Traitement $traitement)
    {
        $request->validate([
            'chien_id' => 'required',
            'nom_traitement' => 'required',
            'date_debut' => 'required',
            'cout' => 'required',
        ]);

        $traitement->update($request->all());

        return redirect()->route('traitements.index')
            ->with('success','Traitement modifié');
    }

    public function show(Traitement $traitement)
    {
        return view('traitements.show', compact('traitement'));
    }

    public function destroy(Traitement $traitement)
    {
        $traitement->delete();

        return redirect()->route('traitements.index')
            ->with('success','Traitement supprimé');
    }
}