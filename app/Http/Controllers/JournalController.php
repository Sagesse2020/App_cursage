<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Models\Transaction;

class JournalController extends Controller
{
   // App\Http\Controllers\JournalController.php
public function index()
{
    // Récupérer toutes les transactions
    $transactions = Transaction::orderBy('date_transaction', 'asc')->get();

    // Créer un tableau pour le journal
    $journal = $transactions->map(function($t) {
        return [
            'date' => $t->date_transaction->format('d/m/Y'),
            'compte' => match($t->type) {
                'paiement_client', 'versement_cursage' => 'Caisse',
                'paiement_partenaire' => 'Banque',
                default => 'Autre'
            },
            'credit' => $t->type === 'paiement_partenaire' ? $t->montant : 0,
            'debit' => in_array($t->type, ['paiement_client','versement_cursage']) ? $t->montant : 0,
            'description' => $t->description ?? $t->type,
        ];
    });

    return view('journal.index', compact('journal'));
}
}
