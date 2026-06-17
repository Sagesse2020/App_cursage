<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Perte;
use App\Models\Achat;
use App\Models\Depense;
use Illuminate\Support\Facades\DB;

class GraphiqueController extends Controller
{
    public function index()
    {
        // =======================
        // 💰 RECETTES (clients)
        // =======================
        $recettes = Transaction::where('type', 'paiement_client')
            ->sum('montant');

        // =======================
        // 💸 CHARGES (sorties)
        // =======================
        $charges = Transaction::whereIn('type', [
            'paiement_partenaire',
            'versement_cursage'
        ])->sum('montant');

        // =======================
        // 📉 PERTES (table dédiée si existante)
        // =======================
        $pertes = Perte::sum('montant') ?? 0;

        // =======================
        // 🧮 BÉNÉFICE
        // =======================
        $benefice = $recettes - ($charges + $pertes);

        // =======================
        // 📋 TRANSACTIONS RÉCENTES
        // =======================
        $transactions = Transaction::with('user')
            ->latest()
            ->take(10)
            ->get();

        // =======================
        // 📊 GRAPH MENSUEL
        // =======================
        $raw = Transaction::selectRaw('MONTH(date_transaction) as mois, SUM(montant) as total')
            ->whereYear('date_transaction', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $donnees = array_fill(0, 12, 0);

        foreach ($raw as $r) {
            $index = $r->mois - 1;
            if ($index >= 0 && $index < 12) {
                $donnees[$index] = (float) $r->total;
            }
        }

        $labels = [
            "Jan", "Fév", "Mar", "Avr", "Mai", "Juin",
            "Juil", "Août", "Sep", "Oct", "Nov", "Déc"
        ];

        return view('graphique', compact(
            'recettes',
            'charges',
            'pertes',
            'benefice',
            'transactions',
            'donnees',
            'labels'
        ));
    }
}