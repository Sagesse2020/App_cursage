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
    ->where('date_transaction', '!=', '')
    ->whereRaw("date_transaction REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}'")
    ->whereYear('date_transaction', date('Y'))
    ->groupBy('mois')
    ->orderBy('mois')
    ->get();

        // 📊 12 mois complets (IMPORTANT)
        $donnees = array_fill(0, 12, 0);

        foreach ($raw as $r) {
            $index = ((int)$r->mois) - 1;

            if ($index >= 0 && $index < 12) {
                $donnees[$index] = (float) $r->total;
            }
        }

        // 🧠 Labels pour affichage pro
        $labels = [
            "Jan", "Fév", "Mar", "Avr", "Mai", "Juin",
            "Juil", "Août", "Sep", "Oct", "Nov", "Déc"
        ];

        return view('graphique', compact('donnees', 'labels'));
    }
}