<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chien;
use App\Models\Vente;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\Partenaire;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{
    public function index()
    {
        return view('gestion.index', [
            'chiensVendus' => Chien::where('statut','vendu')->count(),
            'servicesVendus' => Service::where('statut','termine')->count(),
            'chiensDisponibles' => Chien::where('statut','disponible')->count(),
            'transactions' => Transaction::latest()->limit(10)->get(),
        ]);
    }


    // Export HTML imprimable
    public function exportHtml()
    {
        $data = $this->index()->getData(); // récupère toutes les données du dashboard
        return view('gestion.export', $data);
    }
}
