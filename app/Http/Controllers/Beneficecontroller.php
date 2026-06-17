<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Depense;
use App\Models\Achat;
use App\Models\Perte;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class BeneficeController extends Controller
{
    public function index()
    {
        $recettesTotal = Vente::sum('prix_vente');
        $achatsTotal = Achat::sum('montant_total');
        $depensesTotal = Depense::sum('montant');
        $pertesTotal = Perte::sum('montant');

        $chargesTotal = $achatsTotal + $depensesTotal + $pertesTotal;
        $beneficeTotal = $recettesTotal - $chargesTotal;

        // 🔔 NOTIFICATION INFO (consultation bénéfice)
        Notification::create([
            'titre' => 'Consultation bénéfices',
            'message' => 'Bénéfice calculé : ' . $beneficeTotal . ' FCFA',
            'type' => 'info',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        $stats = [
            [
                'periode' => 'Global',
                'recettes' => $recettesTotal,
                'depenses' => $chargesTotal,
                'benefice' => $beneficeTotal,
            ]
        ];

        return view('benefices.index', compact(
            'recettesTotal',
            'depensesTotal',
            'beneficeTotal',
            'stats'
        ));
    }
}