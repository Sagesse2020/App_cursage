<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\MouvementStock;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MouvementStockController extends Controller
{
    public function index()
    {
        $mouvements = MouvementStock::with(
            'produit',
            'user'
        )
        ->latest()
        ->paginate(15);

        return view(
            'mouvements_stock.index',
            compact('mouvements')
        );
    }

    public function create()
    {
        $produits = Produit::orderBy('nom')->get();

        return view(
            'mouvements_stock.create',
            compact('produits')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'produit_id' => 'required',
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1',
            'motif' => 'required'

        ]);

        $produit = Produit::findOrFail(
            $data['produit_id']
        );

        if ($data['type'] == 'entree')
        {
            $produit->increment(
                'stock',
                $data['quantite']
            );

            NotificationService::create(
                'Entrée de stock',
                "{$data['quantite']} unité(s) ajoutée(s) pour {$produit->nom}",
                'success',
                'stock',
                auth()->id()
            );
        }
        else
        {
            if ($produit->stock < $data['quantite'])
            {
                return back()
                ->with(
                    'error',
                    'Stock insuffisant'
                );
            }

            $produit->decrement(
                'stock',
                $data['quantite']
            );

            NotificationService::create(
                'Sortie de stock',
                "{$data['quantite']} unité(s) retirée(s) de {$produit->nom}",
                'warning',
                'stock',
                auth()->id()
            );
        }

        $data['user_id'] = Auth::id();

        $mouvement = MouvementStock::create($data);

        if ($produit->stock <= 5)
        {
            NotificationService::create(
                'Stock critique',
                "Le produit {$produit->nom} est presque en rupture ({$produit->stock} restant)",
                'danger',
                'stock',
                auth()->id()
            );
        }

        return redirect()
        ->route('mouvements_stock.index')
        ->with(
            'success',
            'Mouvement enregistré'
        );
    }

    public function show(MouvementStock $mouvements_stock)
    {
        return view(
            'mouvements_stock.show',
            compact(
                'mouvements_stock'
            )
        );
    }

    public function destroy(MouvementStock $mouvements_stock)
    {
        $mouvements_stock->delete();

        NotificationService::create(
            'Mouvement supprimé',
            'Un mouvement de stock a été supprimé',
            'danger',
            'stock',
            auth()->id()
        );

        return redirect()
        ->route('mouvements_stock.index')
        ->with(
            'success',
            'Mouvement supprimé'
        );
    }
}