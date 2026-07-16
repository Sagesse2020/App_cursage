<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Depense;
use App\Models\Achat;
use App\Models\Perte;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficeController extends Controller
{

    public function index(Request $request)
    {


        /*
        |--------------------------------------------------------------------------
        | FILTRE DATE
        |--------------------------------------------------------------------------
        */

        $debut = $request->debut;

        $fin = $request->fin;



        /*
        |--------------------------------------------------------------------------
        | RECETTES
        |--------------------------------------------------------------------------
        */


        $ventes = Vente::query();


        if($debut){

            $ventes->whereDate(
                'created_at',
                '>=',
                $debut
            );

        }


        if($fin){

            $ventes->whereDate(
                'created_at',
                '<=',
                $fin
            );

        }


        $recettesTotal = $ventes->sum('prix_vente');



        /*
        |--------------------------------------------------------------------------
        | ACHATS
        |--------------------------------------------------------------------------
        */


        $achats = Achat::query();


        if($debut){

            $achats->whereDate(
                'created_at',
                '>=',
                $debut
            );

        }


        if($fin){

            $achats->whereDate(
                'created_at',
                '<=',
                $fin
            );

        }


        $achatsTotal = $achats->sum('montant_total');



        /*
        |--------------------------------------------------------------------------
        | DEPENSES
        |--------------------------------------------------------------------------
        */


        $depenses = Depense::query();


        if($debut){

            $depenses->whereDate(
                'created_at',
                '>=',
                $debut
            );

        }


        if($fin){

            $depenses->whereDate(
                'created_at',
                '<=',
                $fin
            );

        }


        $depensesTotal = $depenses->sum('montant');



        /*
        |--------------------------------------------------------------------------
        | PERTES
        |--------------------------------------------------------------------------
        */


        $pertes = Perte::query();


        if($debut){

            $pertes->whereDate(
                'created_at',
                '>=',
                $debut
            );

        }


        if($fin){

            $pertes->whereDate(
                'created_at',
                '<=',
                $fin
            );

        }


        $pertesTotal = $pertes->sum('montant');



        /*
        |--------------------------------------------------------------------------
        | CALCUL BENEFICE
        |--------------------------------------------------------------------------
        */


        $chargesTotal =
            $achatsTotal
            +
            $depensesTotal
            +
            $pertesTotal;



        $beneficeTotal =
            $recettesTotal
            -
            $chargesTotal;




        /*
        |--------------------------------------------------------------------------
        | HISTORIQUE
        |--------------------------------------------------------------------------
        */


        $stats = [

            [
                'periode'=> 
                ($debut ?? 'Début')
                .' - '.
                ($fin ?? 'Aujourd’hui'),


                'recettes'=>$recettesTotal,

                'achats'=>$achatsTotal,

                'depenses'=>$depensesTotal,

                'pertes'=>$pertesTotal,

                'benefice'=>$beneficeTotal
            ]

        ];



        Notification::create([

            'titre'=>'Consultation analyse financière',

            'message'=>
            'Bénéfice calculé : '
            .
            number_format(
                $beneficeTotal,
                0,
                ',',
                ' '
            )
            .
            ' FCFA',


            'type'=>'info',

            'lu'=>false,

            'user_id'=>Auth::id()

        ]);



        return view(
            'benefices.index',
            compact(
                'recettesTotal',
                'achatsTotal',
                'depensesTotal',
                'pertesTotal',
                'chargesTotal',
                'beneficeTotal',
                'stats'
            )
        );

    }

}