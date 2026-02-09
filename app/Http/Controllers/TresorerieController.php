<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TresorerieController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('date_transaction')->get();

        $totalEntrees = Transaction::totalEntrees();
        $totalSorties = Transaction::totalSorties();
        $solde = Transaction::solde();

        // Calcul du cumul pour graphique
        $labels = [];
        $cumulData = [];
        $cumul = 0;

        foreach ($transactions as $t) {

            if(in_array($t->type, ['paiement_client','versement_cursage'])){
                $cumul += $t->montant;
            } else {
                $cumul -= $t->montant;
            }

            $labels[] = $t->date_transaction->format('d/m');
            $cumulData[] = $cumul;
        }

        return view('tresorerie.index', compact(
            'transactions',
            'totalEntrees',
            'totalSorties',
            'solde',
            'labels',
            'cumulData'
        ));
    }
}
