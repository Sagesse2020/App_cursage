<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecetteController extends Controller
{
    public function index()
    {
        // =====================
        // RECETTES
        // =====================
        $recettes = Transaction::with('user','vente')
            ->where('type', 'paiement_client')
            ->latest()
            ->paginate(10);

        $totalJour = Transaction::where('type','paiement_client')
            ->whereDate('created_at', today())
            ->sum('montant');

        $totalMois = Transaction::where('type','paiement_client')
            ->whereMonth('created_at', now()->month)
            ->sum('montant');

        $totalAnnee = Transaction::where('type','paiement_client')
            ->whereYear('created_at', now()->year)
            ->sum('montant');

        // =====================
        // NOTIFICATIONS LOGIQUE
        // =====================
        $message = null;
        $typeNotif = null;

        if ($totalJour > 1000000) {
            $message = "🔥 Forte activité aujourd'hui en recettes !";
            $typeNotif = "info";
        }

        if ($totalMois < 500000) {
            $message = "⚠️ Les recettes mensuelles sont faibles.";
            $typeNotif = "warning";
        }

        return view('recettes.index', compact(
            'recettes',
            'totalJour',
            'totalMois',
            'totalAnnee',
            'message',
            'typeNotif'
        ));
    }
}