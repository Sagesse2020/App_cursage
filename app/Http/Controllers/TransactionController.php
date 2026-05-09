<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    /**
     * Affiche la liste des transactions
     */
    public function index()
    {
        // On charge les relations vente et user pour éviter
        // les requêtes multiples vers la base de données (Eager Loading)
        $transactions = Transaction::with(['vente','user'])
                        ->latest()
                        ->paginate(10);

        // Calcul des statistiques financières
        $entrees = Transaction::totalEntrees();
        $sorties = Transaction::totalSorties();
        $solde   = Transaction::solde();

        // Envoi des données vers la vue
        return view('transactions.index',compact(
            'transactions','entrees','sorties','solde'
        ));
    }


    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        // Récupération des ventes pour associer une transaction à une vente
        $ventes = Vente::all();

        return view('transactions.create',compact('ventes'));
    }


    /**
     * Enregistre une nouvelle transaction
     */
    public function store(Request $request)
    {

        // Validation des données du formulaire
        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',

            'vente_id' => 'nullable|exists:ventes,id',

            'type' => 'required|in:paiement_client,paiement_partenaire,versement_cursage,autre',

            'montant' => 'required|numeric|min:0',

            'destinataire' => 'nullable|string|max:255',

            'date_transaction' => 'required|date',

            'notes' => 'nullable|string'
        ]);

        /*
        IMPORTANT

        On ajoute automatiquement l'utilisateur connecté
        afin de savoir qui a effectué la transaction.

        Auth::id() retourne l'id de l'utilisateur connecté.
        */
        $data['user_id'] = Auth::id();


        // Création de la transaction
        Transaction::create($data);


        // Redirection vers la liste avec message succès
        return redirect()
        ->route('transactions.index')
        ->with('success','Transaction enregistrée avec succès');
    }


    /**
     * Affiche le formulaire de modification
     */
    public function edit(Transaction $transaction)
    {
        $ventes = Vente::all();

        return view('transactions.edit',compact(
            'transaction','ventes'
        ));
    }


    /**
     * Met à jour une transaction existante
     */
    public function update(Request $request, Transaction $transaction)
    {

        // Validation des données
        $data = $request->validate([

            'vente_id' => 'nullable|exists:ventes,id',

            'type' => 'required|in:paiement_client,paiement_partenaire,versement_cursage,autre',

            'montant' => 'required|numeric|min:0',

            'destinataire' => 'nullable|string|max:255',

            'date_transaction' => 'nullable|date',

            'notes' => 'nullable|string'

        ]);


        /*
        On ne modifie PAS user_id ici.

        Pourquoi ?

        Parce que l'utilisateur enregistré est
        celui qui a créé la transaction.

        Cela permet de garder un historique fiable.
        */

        $transaction->update($data);


        return redirect()
        ->route('transactions.index')
        ->with('success','Transaction modifiée avec succès');
    }


    /**
     * Supprime une transaction
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return back()
        ->with('success','Transaction supprimée avec succès');
    }
}
