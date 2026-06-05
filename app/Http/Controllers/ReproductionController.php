<?php

namespace App\Http\Controllers;

use App\Models\Reproduction;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReproductionController extends Controller
{
    public function index()
    {
        $reproductions = Reproduction::with(['male','femelle','user'])
            ->latest()
            ->paginate(10);

        return view('reproductions.index', compact('reproductions'));
    }

    public function create()
    {
        $chiens = Chien::all();
        return view('reproductions.create', compact('chiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'male_id' => 'required',
            'femelle_id' => 'required',
            'date_reproduction' => 'required|date',
        ]);

        Reproduction::create([
            'male_id' => $request->male_id,
            'femelle_id' => $request->femelle_id,
            'date_reproduction' => $request->date_reproduction,
            'resultat' => $request->resultat,
            'observations' => $request->observations,
            'user_id' => Auth::id(),
            'lignee_chien' => $request->lignee_chien,
        ]);

        return redirect()->route('reproductions.index')
            ->with('success','Reproduction ajoutée');
    }

    public function edit(Reproduction $reproduction)
    {
        $chiens = Chien::all();
        return view('reproductions.edit', compact('reproduction','chiens'));
    }

    public function update(Request $request, Reproduction $reproduction)
    {
        $request->validate([
            'male_id' => 'required',
            'femelle_id' => 'required',
            'date_reproduction' => 'required',
        ]);

        $reproduction->update($request->all());

        return redirect()->route('reproductions.index')
            ->with('success','Reproduction modifiée');
    }

    public function show(Reproduction $reproduction)
    {
        return view('reproductions.show', compact('reproduction'));
    }

    public function destroy(Reproduction $reproduction)
    {
        $reproduction->delete();

        return redirect()->route('reproductions.index')
            ->with('success','Reproduction supprimée');
    }
}