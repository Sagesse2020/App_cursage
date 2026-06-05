<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Depense;
use App\Models\Achat;
use App\Models\Perte;

class BeneficeController extends Controller
{
    public function index()
    {
        $recettesTotal = Vente::sum('prix_vente');

        $achatsTotal = Achat::sum('montant_total');

        $depensesTotal = Depense::sum('montant');

        $pertesTotal = Perte::sum('montant');

        $chargesTotal =
            $achatsTotal +
            $depensesTotal +
            $pertesTotal;

        $beneficeTotal =
            $recettesTotal -
            $chargesTotal;

        $stats = [
            [
                'periode' => 'Global',
                'recettes' => $recettesTotal,
                'depenses' => $chargesTotal,
                'benefice' => $beneficeTotal,
            ]
        ];

        return view(
            'benefices.index',
            compact(
                'recettesTotal',
                'depensesTotal',
                'beneficeTotal',
                'stats'
            )
        );
    }
}