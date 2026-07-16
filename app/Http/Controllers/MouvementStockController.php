<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use App\Models\Produit;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MouvementStockController extends Controller
{


    public function index(Request $request)
    {

        $query = MouvementStock::with([
            'produit',
            'user'
        ]);


        /*
        |--------------------------------------------------------------------------
        | FILTRE PRODUIT
        |--------------------------------------------------------------------------
        */

        if($request->filled('produit'))
        {

            $query->whereHas(
                'produit',
                function($q) use($request)
                {

                    $q->where(
                        'nom',
                        'like',
                        '%'.$request->produit.'%'
                    );

                }
            );

        }



        /*
        |--------------------------------------------------------------------------
        | FILTRE TYPE
        |--------------------------------------------------------------------------
        */

        if($request->filled('type'))
        {

            $query->where(
                'type',
                $request->type
            );

        }




        /*
        |--------------------------------------------------------------------------
        | FILTRE DATE
        |--------------------------------------------------------------------------
        */


        if($request->filled('date_debut'))
        {

            $query->whereDate(
                'created_at',
                '>=',
                $request->date_debut
            );

        }


        if($request->filled('date_fin'))
        {

            $query->whereDate(
                'created_at',
                '<=',
                $request->date_fin
            );

        }




        $mouvements = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();



        return view(
            'mouvements_stock.index',
            compact('mouvements')
        );

    }





    public function create()
    {

        $produits = Produit::all();


        return view(
            'mouvements_stock.create',
            compact('produits')
        );

    }





    public function store(Request $request)
    {


        $data = $request->validate([

            'produit_id'=>'required|exists:produits,id',

            'type'=>'required|in:entree,sortie',

            'quantite'=>'required|integer|min:1',

            'motif'=>'nullable|string'

        ]);




        /*
        |--------------------------------------------------------------------------
        | VERIFICATION STOCK
        |--------------------------------------------------------------------------
        */


        $produit = Produit::findOrFail(
            $data['produit_id']
        );



        if(
            $data['type']=="sortie"
            &&
            $produit->stock < $data['quantite']
        )
        {

            return back()
            ->withErrors(
                'Stock insuffisant'
            );

        }




        /*
        |--------------------------------------------------------------------------
        | CREATION MOUVEMENT
        |--------------------------------------------------------------------------
        */


        $data['user_id']=Auth::id();



        $mouvement = MouvementStock::create($data);



        /*
        |--------------------------------------------------------------------------
        | MAJ STOCK
        |--------------------------------------------------------------------------
        */


        if($data['type']=="entree")
        {

            $produit->increment(
                'stock',
                $data['quantite']
            );

        }
        else
        {

            $produit->decrement(
                'stock',
                $data['quantite']
            );

        }





        NotificationService::create(

            'Mouvement stock créé',

            "Le mouvement {$data['type']} de {$data['quantite']} unités du produit {$produit->nom} a été enregistré.",

            'info',

            'stock',

            Auth::id()

        );




        return redirect()

            ->route('mouvements_stock.index')

            ->with(
                'success',
                'Mouvement enregistré'
            );


    }







    public function edit(MouvementStock $mouvement)
    {


        if(
            Auth::id() != $mouvement->user_id
            &&
            Auth::user()->niveau_admin < 2
        )
        {

            abort(403);

        }



        $produits = Produit::all();



        return view(
            'mouvements_stock.edit',
            compact(
                'mouvement',
                'produits'
            )
        );

    }








    public function update(
        Request $request,
        MouvementStock $mouvement
    )
    {


        if(
            Auth::id() != $mouvement->user_id
            &&
            Auth::user()->niveau_admin < 2
        )
        {

            abort(403);

        }



        $data=$request->validate([

            'produit_id'=>'required',

            'type'=>'required|in:entree,sortie',

            'quantite'=>'required|integer|min:1',

            'motif'=>'nullable'

        ]);



        $mouvement->update($data);



        NotificationService::create(

            'Mouvement stock modifié',

            "Le mouvement stock #{$mouvement->id} a été modifié.",

            'warning',

            'stock',

            Auth::id()

        );



        return redirect()

        ->route('mouvements_stock.index')

        ->with(
            'success',
            'Mouvement modifié'
        );

    }








    public function destroy(
        MouvementStock $mouvement
    )
    {


        if(
            Auth::id() != $mouvement->user_id
            &&
            Auth::user()->niveau_admin < 2
        )
        {

            abort(403);

        }



        $produit = $mouvement->produit;



        /*
        Retour stock avant suppression
        */


        if($mouvement->type=="entree")
        {

            $produit->decrement(
                'stock',
                $mouvement->quantite
            );

        }
        else
        {

            $produit->increment(
                'stock',
                $mouvement->quantite
            );

        }



        $id=$mouvement->id;



        $mouvement->delete();




        NotificationService::create(

            'Mouvement stock supprimé',

            "Le mouvement stock #{$id} a été supprimé.",

            'danger',

            'stock',

            Auth::id()

        );




        return back()

        ->with(
            'success',
            'Mouvement supprimé'
        );


    }



}