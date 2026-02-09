<?php
namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    /**
     * Afficher la liste des races
     */
    public function index()
    {
        $races = Race::orderBy('nom')->get();
        return view('races.index', compact('races'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('races.create');
    }

    /**
     * Enregistrer une nouvelle race
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:races,nom',
            'description' => 'nullable|string',
        ]);

        Race::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('races.index')
            ->with('success', 'Race ajoutée avec succès.');
    }

    /**
     * Afficher une race précise
     */
    public function show(Race $race)
    {
        return view('races.show', compact('race'));
    }

    /**
     * Afficher le formulaire d’édition
     */
    public function edit(Race $race)
    {
        return view('races.edit', compact('race'));
    }

    /**
     * Mettre à jour une race
     */
    public function update(Request $request, Race $race)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:races,nom,' . $race->id,
            'description' => 'nullable|string',
        ]);

        $race->update([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('races.index')
            ->with('success', 'Race modifiée avec succès.');
    }

    /**
     * Supprimer une race
     */
    public function destroy(Race $race)
    {
        $race->delete();

        return redirect()
            ->route('races.index')
            ->with('success', 'Race supprimée avec succès.');
    }
}

