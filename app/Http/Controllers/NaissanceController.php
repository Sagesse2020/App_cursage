<?php

namespace App\Http\Controllers;

use App\Models\Naissance;
use App\Models\Reproduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NaissanceController extends Controller
{
    public function index()
    {
        $naissances = Naissance::with('reproduction')
            ->latest()
            ->paginate(10);

        return view('naissances.index', compact('naissances'));
    }

    public function create()
    {
        $reproductions = Reproduction::with(['male','femelle'])->get();
        return view('naissances.create', compact('reproductions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reproduction_id' => 'required',
            'date_naissance' => 'required|date',
        ]);

        Naissance::create([
            'reproduction_id' => $request->reproduction_id,
            'date_naissance' => $request->date_naissance,
            'nombre_males' => $request->nombre_males,
            'nombre_femelles' => $request->nombre_femelles,
            'nombre_morts' => $request->nombre_morts,
            'observation' => $request->observation,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('naissances.index')
            ->with('success','Naissance enregistrée');
    }

    public function edit(Naissance $naissance)
    {
        $reproductions = Reproduction::with(['male','femelle'])->get();
        return view('naissances.edit', compact('naissance','reproductions'));
    }

    public function update(Request $request, Naissance $naissance)
    {
        $request->validate([
            'reproduction_id' => 'required',
            'date_naissance' => 'required',
        ]);

        $naissance->update($request->all());

        return redirect()->route('naissances.index')
            ->with('success','Naissance modifiée');
    }

    public function show(Naissance $naissance)
    {
        return view('naissances.show', compact('naissance'));
    }

    public function destroy(Naissance $naissance)
    {
        $naissance->delete();

        return redirect()->route('naissances.index')
            ->with('success','Naissance supprimée');
    }
}