<?php

namespace App\Http\Controllers;

use App\Models\Perte;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerteController extends Controller
{

    public function index(Request $request)
    {

        $query = Perte::with('user');


        /*
        |--------------------------------------------------------------------------
        | FILTRE TYPE
        |--------------------------------------------------------------------------
        */

        if($request->filled('type')){

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

        if($request->filled('debut')){

            $query->whereDate(
                'created_at',
                '>=',
                $request->debut
            );

        }


        if($request->filled('fin')){

            $query->whereDate(
                'created_at',
                '<=',
                $request->fin
            );

        }



        /*
        |--------------------------------------------------------------------------
        | RECHERCHE
        |--------------------------------------------------------------------------
        */

        if($request->filled('search')){

            $query->where(function($q) use ($request){

                $q->where(
                    'libelle',
                    'LIKE',
                    '%'.$request->search.'%'
                )

                ->orWhere(
                    'description',
                    'LIKE',
                    '%'.$request->search.'%'
                );

            });

        }



        /*
        |--------------------------------------------------------------------------
        | LISTE
        |--------------------------------------------------------------------------
        */

        $pertes = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();



        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES
        |--------------------------------------------------------------------------
        */

        $total = Perte::sum('montant');


        $nombre = Perte::count();


        $deces = Perte::where(
            'type',
            'Décès'
        )->count();


        $perimes = Perte::where(
            'type',
            'Produit périmé'
        )->count();


        $casses = Perte::where(
            'type',
            'Produit cassé'
        )->count();


        $vols = Perte::where(
            'type',
            'Vol'
        )->count();


        $annulations = Perte::where(
            'type',
            'Annulation'
        )->count();



        return view(
            'pertes.index',
            compact(
                'pertes',
                'total',
                'nombre',
                'deces',
                'perimes',
                'casses',
                'vols',
                'annulations'
            )
        );

    }



    public function destroy(Perte $perte)
    {


        $libelle = $perte->libelle;


        $montant = $perte->montant;


        $perte->delete();



        Notification::create([

            'titre'=>'Perte supprimée',

            'message'=>
            "La perte {$libelle} de ".
            number_format($montant,0,',',' ').
            " FCFA a été supprimée.",

            'type'=>'danger',

            'lu'=>false,

            'user_id'=>Auth::id()

        ]);



        return back()->with(
            'success',
            'Perte supprimée avec succès.'
        );

    }

}