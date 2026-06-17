<?php

namespace App\Http\Controllers;

use App\Models\Perte;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerteController extends Controller
{
    public function index()
    {
        $pertes = Perte::with('user')
            ->latest()
            ->paginate(20);

        $total_pertes = Perte::sum('montant');

        return view('pertes.index', compact('pertes', 'total_pertes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'montant' => 'required|numeric',
            'motif' => 'required|string'
        ]);

        $perte = Perte::create([
            ...$data,
            'user_id' => Auth::id()
        ]);

        // 🔔 NOTIFICATION CREATE
        Notification::create([
            'titre' => 'Nouvelle perte enregistrée',
            'message' => 'Perte de ' . $perte->montant . ' FCFA ajoutée',
            'type' => 'warning',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Perte ajoutée');
    }

    public function destroy(Perte $perte)
    {
        $montant = $perte->montant;

        $perte->delete();

        // 🔔 NOTIFICATION DELETE
        Notification::create([
            'titre' => 'Perte supprimée',
            'message' => 'Perte de ' . $montant . ' FCFA supprimée',
            'type' => 'danger',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Perte supprimée');
    }
}