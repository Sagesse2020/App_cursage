<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RaceController extends Controller
{
    /**
     * Liste des races
     */
    public function index()
    {
        $races = Race::orderBy('nom')->get();
        return view('races.index', compact('races'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        return view('races.create');
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:150|unique:races,nom',
            'origine' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 🔥 UPLOAD IMAGE
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('races', 'public');
        }

        Race::create([
            'nom' => $request->nom,
            'origine' => $request->origine,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('races.index')
            ->with('success', 'Race ajoutée avec succès.');
    }

    /**
     * Affichage d’une race
     */
    public function show(Race $race)
    {
        return view('races.show', compact('race'));
    }

    /**
     * Formulaire édition
     */
    public function edit(Race $race)
    {
        return view('races.edit', compact('race'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Race $race)
    {
        $request->validate([
            'nom' => 'required|string|max:150|unique:races,nom,' . $race->id,
            'origine' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 🔥 SI NOUVELLE IMAGE → SUPPRIMER L’ANCIENNE
        if ($request->hasFile('image')) {
            if ($race->image && Storage::disk('public')->exists($race->image)) {
                Storage::disk('public')->delete($race->image);
            }

            $race->image = $request->file('image')->store('races', 'public');
        }

        $race->update([
            'nom' => $request->nom,
            'origine' => $request->origine,
            'description' => $request->description,
            'image' => $race->image,
        ]);

        return redirect()->route('races.index')
            ->with('success', 'Race modifiée avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Race $race)
    {
        // 🔥 SUPPRESSION IMAGE
        if ($race->image && Storage::disk('public')->exists($race->image)) {
            Storage::disk('public')->delete($race->image);
        }

        $race->delete();

        return redirect()->route('races.index')
            ->with('success', 'Race supprimée avec succès.');
    }
}
