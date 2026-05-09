<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GraphiqueController extends Controller
{
    public function index()
{
    $donnees = DB::table('transactions')
        ->whereNotNull('date_transaction')
        ->selectRaw('MONTH(date_transaction) as mois, SUM(montant) as total')
        ->whereYear('date_transaction', Carbon::now()->year)
        ->groupBy('mois')
        ->orderBy('mois')
        ->pluck('total');

    return view('graphique', compact('donnees'));
}
}
