<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use App\Models\Chien;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraitementController extends Controller
{
    public function index()
    {
        $traitements = Traitement::with(['chien','user'])
            ->latest()
            ->paginate(10);

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

        $traitement = Traitement::create([
            'chien_id' => $request->chien_id,
            'nom_traitement' => $request->nom_traitement,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'cout' => $request->cout,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // 🔔 NOTIFICATION CREATE
        Notification::create([
            'titre' => 'Nouveau traitement',
            'message' => 'Traitement "' . $traitement->nom_traitement . '" ajouté',
            'type' => 'success',
            'lu' => false,
            'user_id' => Auth::id()
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

        // 🔔 NOTIFICATION UPDATE
        Notification::create([
            'titre' => 'Traitement modifié',
            'message' => 'Traitement "' . $traitement->nom_traitement . '" modifié',
            'type' => 'info',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('traitements.index')
            ->with('success','Traitement modifié');
    }

    public function show(Traitement $traitement)
    {
        return view('traitements.show', compact('traitement'));
    }

    public function destroy(Traitement $traitement)
    {
        $nom = $traitement->nom_traitement;

        $traitement->delete();

        // 🔔 NOTIFICATION DELETE
        Notification::create([
            'titre' => 'Traitement supprimé',
            'message' => 'Traitement "' . $nom . '" supprimé',
            'type' => 'danger',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('traitements.index')
            ->with('success','Traitement supprimé');
    }
}