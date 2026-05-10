<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GraphiqueController extends Controller
{
    public function index()
    {
        $raw = DB::table('transactions')
            ->selectRaw('MONTH(date_transaction) as mois, SUM(montant) as total')
            ->whereNotNull('date_transaction')
            ->whereYear('date_transaction', Carbon::now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // 📊 init 12 mois
        $donnees = array_fill(1, 12, 0);

        foreach ($raw as $r) {
            if ($r->mois >= 1 && $r->mois <= 12) {
                $donnees[$r->mois] = (float) $r->total;
            }
        }

        // 🔥 DEBUG IMPORTANT (à activer si bug)
        // dd($donnees);

        return view('graphique', compact('donnees'));
    }
}