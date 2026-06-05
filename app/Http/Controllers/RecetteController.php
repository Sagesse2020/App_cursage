<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    public function index()
    {
        $recettes = Transaction::with('user','vente')
            ->latest()
            ->paginate(10);

        $totalJour = Transaction::whereDate('created_at',today())->sum('montant');
        $totalMois = Transaction::whereMonth('created_at',now()->month)->sum('montant');
        $totalAnnee = Transaction::whereYear('created_at',now()->year)->sum('montant');

        return view('recettes.index', compact(
            'recettes',
            'totalJour',
            'totalMois',
            'totalAnnee'
        ));
    }
}