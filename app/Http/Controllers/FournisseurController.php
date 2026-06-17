<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index(Request $request)
    {
        $query = Fournisseur::query();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%')
                  ->orWhere('telephone', 'like', '%'.$request->search.'%');
        }

        $fournisseurs = $query->latest()->paginate(10);

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:fournisseurs,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string'
        ]);

        Fournisseur::create($data);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès');
    }

    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show', compact('fournisseur'));
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:fournisseurs,email,'.$fournisseur->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string'
        ]);

        $fournisseur->update($data);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur modifié');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return back()->with('success', 'Fournisseur supprimé');
    }
}