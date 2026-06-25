<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Visit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatistiqueController extends Controller
{

private function checkAlerts()
{
    // =====================
    // 1. VISITES ÉLEVÉES
    // =====================
    $highVisits = Visit::select('page_visited', DB::raw('count(*) as total'))
        ->groupBy('page_visited')
        ->having('total', '>=', 50)
        ->get();

    foreach ($highVisits as $visit) {
        NotificationService::create(
            "Page très visitée",
            "La page {$visit->page_visited} a dépassé {$visit->total} visites.",
            "warning",
            "visits",
             Auth::id()
        );
    }

    // =====================
    // 2. CONNEXIONS JOUR
    // =====================
    $activeUsers = DB::table('logins_temp')
        ->select('user_id', DB::raw('count(*) as total'))
        ->whereDate('logged_in_at', Carbon::today())
        ->groupBy('user_id')
        ->having('total', '>=', 5)
        ->get();

    foreach ($activeUsers as $user) {
        NotificationService::create(
            "Utilisateur actif",
            "Vous avez dépassé 5 connexions aujourd'hui.",
            "info",
            "logins",
            $user->user_id
        );
    }

    // =====================
    // 3. UTILISATEUR TRÈS ACTIF
    // =====================
    $weeklyUsers = DB::table('logins_temp')
        ->select('user_id', DB::raw('count(*) as total'))
        ->where('logged_in_at', '>=', Carbon::now()->subWeek())
        ->groupBy('user_id')
        ->having('total', '>=', 20)
        ->get();

    foreach ($weeklyUsers as $user) {
        NotificationService::create(
            "Utilisateur très actif",
            "Vous avez dépassé 20 connexions cette semaine.",
            "danger",
            "logins",
            $user->user_id
        );
    }
}
    public function index()
{
    $this->checkAlerts(); // 🔥 relié au service

    $totalVisits = Visit::count();
    $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');

    $visitsByPage = Visit::select('page_visited', DB::raw('count(*) as total'))
        ->groupBy('page_visited')
        ->orderByDesc('total')
        ->paginate(10);

    $logins = DB::table('logins_temp')
        ->join('users', 'logins_temp.user_id', '=', 'users.id')
        ->select('users.name', 'logins_temp.logged_in_at')
        ->orderByDesc('logged_in_at')
        ->paginate(10);

    return view('statistiques', compact(
        'totalVisits',
        'uniqueVisitors',
        'visitsByPage',
        'logins'
    ));
}
}