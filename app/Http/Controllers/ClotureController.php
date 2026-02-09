<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClotureController extends Controller
{
    /**
     * Afficher la clôture du mois en cours
     */
    public function index()
    {
        $mois = Carbon::now()->format('F Y'); // exemple : Février 2026

        // On récupère toutes les transactions du mois en cours
        $transactions = DB::table('transactions')
            ->whereMonth('date_transaction', Carbon::now()->month)
            ->whereYear('date_transaction', Carbon::now()->year)
            ->orderBy('date_transaction', 'asc')
            ->get();

        // Calcul des totaux
        $entrees = $transactions->whereIn('type', ['paiement_client', 'versement_cursage'])->sum('montant');
        $sorties = $transactions->whereIn('type', ['paiement_partenaire', 'autre'])->sum('montant');
        $resultat = $entrees - $sorties;

        return view('cloture', compact('mois', 'entrees', 'sorties', 'resultat', 'transactions'));
    }

    /**
     * Valider la clôture et archiver les transactions
     */
    public function valider(Request $request)
    {
        DB::transaction(function() {
            // On récupère toutes les transactions du mois en cours
            $transactions = DB::table('transactions')
                ->whereMonth('date_transaction', Carbon::now()->month)
                ->whereYear('date_transaction', Carbon::now()->year)
                ->get();

            // On peut les copier dans une table d'historique si tu veux garder trace
            foreach ($transactions as $t) {
                DB::table('transactions_historique')->insert([
                    'vente_id' => $t->vente_id,
                    'type' => $t->type,
                    'montant' => $t->montant,
                    'destinataire' => $t->destinataire,
                    'date_transaction' => $t->date_transaction,
                    'notes' => $t->notes,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Supprimer les transactions du mois courant (optionnel, si archivées)
            DB::table('transactions')
                ->whereMonth('date_transaction', Carbon::now()->month)
                ->whereYear('date_transaction', Carbon::now()->year)
                ->delete();
        });

        return redirect()->route('cloture')
                         ->with('success', 'Clôture mensuelle validée et archivées avec succès !');
    }
}
