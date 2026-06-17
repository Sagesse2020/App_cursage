<?php

namespace App\Http\Controllers;

use App\Models\FicheSuivi;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheSuiviController extends Controller
{
    public function index(Request $request)
    {
        $query = FicheSuivi::with('chien');

    if($request->search)
    {
        $query->whereHas('chien', function($q) use ($request){

            $q->where(
                'nom',
                'like',
                '%'.$request->search.'%'
            );

        });
    }

    if($request->etat)
    {
        $query->where(
            'etat_general',
            $request->etat
        );
    }

    $fiches = $query
                ->latest()
                ->paginate(10);

    return view(
        'fiches_suivi.index',
        compact('fiches')
    );
    }

    public function create()
    {
        $chiens = Chien::all();
        return view('fiches_suivi.create', compact('chiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chien_id' => 'required',
            'date_suivi' => 'required|date',
        ]);

        FicheSuivi::create([
            'chien_id' => $request->chien_id,
            'poids' => $request->poids,
            'temperature' => $request->temperature,
            'etat_general' => $request->etat_general,
            'alimentation' => $request->alimentation,
            'observation' => $request->observation,
            'date_suivi' => $request->date_suivi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('fiches_suivi.index')
            ->with('success','Fiche ajoutée');
    }

    public function edit(FicheSuivi $fiches_suivi)
    {
        $chiens = Chien::all();
        return view('fiches_suivi.edit', [
            'fiche' => $fiches_suivi,
            'chiens' => $chiens
        ]);
    }

    public function update(Request $request, FicheSuivi $fiches_suivi)
    {
        $request->validate([
            'chien_id' => 'required',
            'date_suivi' => 'required',
        ]);

        $fiches_suivi->update($request->all());

        return redirect()->route('fiches_suivi.index')
            ->with('success','Fiche modifiée');
    }

    public function show(FicheSuivi $fiches_suivi)
    {
        return view('fiches_suivi.show', [
            'fiche' => $fiches_suivi
        ]);
    }

    public function destroy(FicheSuivi $fiches_suivi)
    {
        $fiches_suivi->delete();

        return redirect()->route('fiches_suivi.index')
            ->with('success','Fiche supprimée');
    }
}