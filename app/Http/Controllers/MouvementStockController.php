<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\MouvementStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MouvementStockController extends Controller
{
    public function index()
    {
        $mouvements =
        MouvementStock::with(
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
        $produits =
        Produit::orderBy('nom')
        ->get();

        return view(
            'mouvements_stock.create',
            compact('produits')
        );
    }

    public function store(Request $request)
    {
        $data =
        $request->validate([

            'produit_id'=>'required',

            'type'=>'required|in:entree,sortie',

            'quantite'=>'required|integer|min:1',

            'motif'=>'required'

        ]);

        $produit =
        Produit::findOrFail(
            $data['produit_id']
        );

        if(
            $data['type']=='entree'
        )
        {
            $produit->increment(
                'stock',
                $data['quantite']
            );
        }
        else
        {
            if(
                $produit->stock <
                $data['quantite']
            )
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
        }

        $data['user_id'] =
        Auth::id();

        MouvementStock::create(
            $data
        );

        return redirect()
        ->route(
            'mouvements_stock.index'
        )
        ->with(
            'success',
            'Mouvement enregistré'
        );
    }

    public function show(
        MouvementStock $mouvements_stock
    )
    {
        return view(
            'mouvements_stock.show',
            compact(
                'mouvements_stock'
            )
        );
    }
}