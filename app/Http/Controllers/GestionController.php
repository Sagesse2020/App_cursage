<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chien;
use App\Models\Vente;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Partenaire;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{
   public function index()
{
    $users = User::latest()->get();

    return view('gestion.index', [
        // cartes
        'totalUsers' => $users->count(),
        'totalPartners' => Partenaire::count(),

        // graph
        'totalVentes' => Vente::count(),
        'totalServices' => Service::count(),
        'totalChiens' => Chien::count(),

        // stats
        'chiensVendus' => Chien::where('statut','vendu')->count(),
        'servicesVendus' => Service::where('statut','termine')->count(),
        'chiensDisponibles' => Chien::where('statut','disponible')->count(),

        'transactions' => Transaction::latest()->limit(10)->get(),

        // IMPORTANT
        'users' => $users,
    ]);
}
    // Export HTML imprimable
    public function exportHtml()
    {
        $data = $this->index()->getData(); // récupère toutes les données du dashboard
        return view('gestion.export', $data);
    }
}
