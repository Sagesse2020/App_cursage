<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchatController extends Controller
{
    public function index()
    {
        $achats = Achat::with(
            'produit',
            'user'
        )
        ->latest()
        ->paginate(10);

        return view(
            'achats.index',
            compact('achats')
        );
    }

    public function create()
    {
        $produits = Produit::all();

        return view(
            'achats.create',
            compact('produits')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'produit_id'=>'required',
            'quantite'=>'required|integer|min:1',
            'prix_unitaire'=>'required|numeric|min:0',
            'fournisseur'=>'nullable',
            'date_achat'=>'required|date',
            'observation'=>'nullable',

        ]);

        $data['reference'] =
            'ACH-'.time();

        $data['user_id'] =
            Auth::id();

        $data['montant_total'] =
            $data['quantite']
            *
            $data['prix_unitaire'];

        $achat = Achat::create($data);

        $achat->produit->increment(
            'stock',
            $achat->quantite
        );

        return redirect()
            ->route('achats.index')
            ->with(
                'success',
                'Achat enregistré'
            );
    }

    public function show(Achat $achat)
    {
        return view(
            'achats.show',
            compact('achat')
        );
    }

    public function edit(Achat $achat)
    {
        $produits = Produit::all();

        return view(
            'achats.edit',
            compact(
                'achat',
                'produits'
            )
        );
    }

    public function update(
        Request $request,
        Achat $achat
    )
    {
        $ancienStock =
            $achat->quantite;

        $data = $request->validate([

            'produit_id'=>'required',

            'quantite'=>'required|integer|min:1',

            'prix_unitaire'=>'required|numeric|min:0',

            'fournisseur'=>'nullable',

            'date_achat'=>'required|date',

            'observation'=>'nullable',
        ]);

        $data['montant_total'] =
            $data['quantite']
            *
            $data['prix_unitaire'];

        $achat->produit->decrement(
            'stock',
            $ancienStock
        );

        $achat->update($data);

        $achat->produit->increment(
            'stock',
            $achat->quantite
        );

        return redirect()
            ->route('achats.index');
    }

    public function destroy(Achat $achat)
    {
        $achat->produit->decrement(
            'stock',
            $achat->quantite
        );

        $achat->delete();

        return back();
    }
}