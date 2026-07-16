<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationService;


class AchatController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LISTE + FILTRE
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {

        $query = Achat::with([
            'produit',
            'user',  'fournisseur'
        ]);


        // Recherche référence / fournisseur / produit

        if($request->filled('search'))
        {

            $query->where(function($q) use($request){

                $q->where(
                    'reference',
                    'LIKE',
                    '%'.$request->search.'%'
                )

                ->orWhere(
                    'fournisseur',
                    'LIKE',
                    '%'.$request->search.'%'
                )

                ->orWhereHas(
                    'produit',
                    function($p) use($request){

                        $p->where(
                            'nom',
                            'LIKE',
                            '%'.$request->search.'%'
                        );

                    }
                );

            });

        }


        // Date début

        if($request->filled('debut'))
        {

            $query->whereDate(
                'date_achat',
                '>=',
                $request->debut
            );

        }


        // Date fin

        if($request->filled('fin'))
        {

            $query->whereDate(
                'date_achat',
                '<=',
                $request->fin
            );

        }

        $achats = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();



        return view(
            'achats.index',
            compact('achats')
        );

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */


    public function create()
    {
$produits = Produit::all();

    $fournisseurs = Fournisseur::all();


    return view(
        'achats.create',
        compact(
            'produits',
            'fournisseurs'
        )
    );

    }





    /*
    |--------------------------------------------------------------------------
    | ENREGISTREMENT
    |--------------------------------------------------------------------------
    */


    public function store(Request $request)
    {


        $data = $request->validate([

            'produit_id'=>'required',
            'quantite'=>'required|integer|min:1',
            'prix_unitaire'=>'required|numeric|min:0',
            'fournisseur_id'=>'required',
            'date_achat'=>'required|date',
            'observation'=>'nullable'

        ]);

        DB::transaction(function() use($data){

            $data['reference'] =
                'ACH-'.date('YmdHis');


            $data['user_id']=Auth::id();


            $data['montant_total'] =
                $data['quantite']
                *
                $data['prix_unitaire'];



            $achat = Achat::create($data);



            $achat->produit->increment(
                'stock',
                $achat->quantite
            );



            NotificationService::create(

                'Nouvel achat',

                "Achat {$achat->reference} enregistré pour {$achat->montant_total} FCFA.",

                'success',

                'achat',

                Auth::id()

            );


        });



        return redirect()
            ->route('achats.index')
            ->with(
                'success',
                'Achat enregistré'
            );

    }




    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show(Achat $achat)
    {

        return view(
            'achats.show',
            compact('achat')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

  public function edit(Achat $achat)
{
    $produits = Produit::all();

    $fournisseurs = Fournisseur::all();


    return view(
        'achats.edit',
        compact(
            'achat',
            'produits',
            'fournisseurs'
        )
    );
}




    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */


    public function update(
        Request $request,
        Achat $achat
    )
    {


        $data=$request->validate([

            'produit_id'=>'required',

            'quantite'=>'required|integer|min:1',

            'prix_unitaire'=>'required|numeric|min:0',

           'fournisseur_id'=>'nullable|exists:fournisseurs,id',

            'date_achat'=>'required|date',

            'observation'=>'nullable'

        ]);



        DB::transaction(function() use($data,$achat){


            // retirer ancien stock

            $achat->produit->decrement(
                'stock',
                $achat->quantite
            );



            $data['montant_total'] =
                $data['quantite']
                *
                $data['prix_unitaire'];



            $achat->update($data);



            // ajouter nouveau stock

            $achat->produit->increment(
                'stock',
                $achat->quantite
            );




            NotificationService::create(

                'Achat modifié',

                "L'achat {$achat->reference} a été modifié.",

                'warning',

                'achat',

                Auth::id()

            );


        });



        return redirect()
            ->route('achats.index');

    }





    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */


    public function destroy(Achat $achat)
    {


        DB::transaction(function() use($achat){


            $achat->produit->decrement(
                'stock',
                $achat->quantite
            );


            $reference=$achat->reference;


            $achat->delete();



            NotificationService::create(

                'Achat supprimé',

                "L'achat {$reference} a été supprimé.",

                'danger',

                'achat',

                Auth::id()

            );


        });



        return back()
        ->with(
            'success',
            'Achat supprimé'
        );

    }

}