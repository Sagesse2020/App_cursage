<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Visit;
use App\Models\Transaction;

class StatistiqueController extends Controller
{
    public function index()
    {
        // =====================
        // VISITES
        // =====================
        $totalVisits = Visit::count();
        $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');

        $visitsByPage = Visit::select('page_visited', DB::raw('count(*) as total'))
            ->groupBy('page_visited')
            ->orderByDesc('total')
            ->paginate(10);

        // =====================
        // FINANCE GLOBAL
        // =====================
        $recettes = Transaction::where('type','paiement_client')->sum('montant');

        $charges = Transaction::whereIn('type',[
            'paiement_partenaire',
            'versement_cursage'
        ])->sum('montant');

        $benefice = $recettes - $charges;

        // =====================
        // NOTIFICATIONS
        // =====================
        $alert = null;
        $alertType = null;

        if ($benefice < 0) {
            $alert = "🚨 Attention : votre entreprise est en perte !";
            $alertType = "danger";
        } elseif ($benefice > 1000000) {
            $alert = "💰 Excellent bénéfice ce mois-ci !";
            $alertType = "success";
        }

        if ($charges > $recettes) {
            $alert = "⚠️ Les charges dépassent les recettes.";
            $alertType = "warning";
        }

        return view('statistiques', compact(
            'totalVisits',
            'uniqueVisitors',
            'visitsByPage',
            'recettes',
            'charges',
            'benefice',
            'alert',
            'alertType'
        ));
    }
}