<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecesController extends Controller
{
    public function index(Request $request)
    {
        $query = Deces::with(['chien','user'])->latest();

        // ================= FILTRES =================
        if ($request->chien) {
            $query->whereHas('chien', function ($q) use ($request) {
                $q->where('nom', 'like', '%'.$request->chien.'%');
            });
        }

        if ($request->date_debut) {
            $query->whereDate('date_deces', '>=', $request->date_debut);
        }

        if ($request->date_fin) {
            $query->whereDate('date_deces', '<=', $request->date_fin);
        }

        $deces = $query->paginate(10);

        return view('deces.index', compact('deces'));
    }

    public function create()
    {
        $chiens = Chien::all();
        return view('deces.create', compact('chiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chien_id' => 'required',
            'date_deces' => 'required|date',
        ]);

        Deces::create([
            'chien_id' => $request->chien_id,
            'cause' => $request->cause,
            'date_deces' => $request->date_deces,
            'observation' => $request->observation,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('deces.index')
            ->with('success','Décès enregistré');
    }

    public function show(Deces $deces)
    {
        return view('deces.show', compact('deces'));
    }

    public function edit(Deces $deces)
    {
        $chiens = Chien::all();
        return view('deces.edit', compact('deces','chiens'));
    }

    public function update(Request $request, Deces $deces)
    {
        $request->validate([
            'chien_id' => 'required',
            'date_deces' => 'required',
        ]);

        $deces->update($request->all());

        return redirect()->route('deces.index')
            ->with('success','Décès modifié');
    }

    public function destroy(Deces $deces)
    {
        $deces->delete();

        return redirect()->route('deces.index')
            ->with('success','Décès supprimé');
    }
}