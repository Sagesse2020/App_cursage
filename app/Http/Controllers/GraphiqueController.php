<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GraphiqueController extends Controller
{
    public function index()
    {
        // Exemple : récupérer le total des ventes par mois
        $donnees = DB::table('transactions')
            ->selectRaw('MONTH(date_transaction) as mois, SUM(montant) as total')
            ->whereYear('date_transaction', Carbon::now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total'); // ça renvoie un tableau [1000, 2000, 1500,...]

        return view('graphique', compact('donnees'));
    }
}
