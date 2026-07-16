<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use App\Models\Chien;
use App\Models\Perte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class DecesController extends Controller
{
    public function index(Request $request)
    {
        $query = Deces::with([
            'chien',
            'user'
        ])->latest();


        if ($request->chien)
        {
            $query->whereHas(
                'chien',
                function ($q) use ($request)
                {
                    $q->where(
                        'nom',
                        'like',
                        '%'.$request->chien.'%'
                    );
                }
            );
        }


        if ($request->date_debut)
        {
            $query->whereDate(
                'date_deces',
                '>=',
                $request->date_debut
            );
        }


        if ($request->date_fin)
        {
            $query->whereDate(
                'date_deces',
                '<=',
                $request->date_fin
            );
        }


        $deces = $query->paginate(10);


        return view(
            'deces.index',
            compact('deces')
        );
    }



    public function create()
    {
        $users = User::all();

        $chiens = Chien::all();


        return view(
            'deces.create',
            compact(
                'chiens',
                'users'
            )
        );
    }



    public function store(Request $request)
    {
        $request->validate([

            'chien_id' => 'required',

            'date_deces' => 'required|date',

        ]);



        /*
        |--------------------------------------------------------------------------
        | Création du décès
        |--------------------------------------------------------------------------
        */

        $deces = Deces::create([

            'chien_id' => $request->chien_id,

            'date_deces' => $request->date_deces,

            'cause' => $request->cause,

            'description' => $request->description,

            'user_id' => Auth::id(),

        ]);



        /*
        |--------------------------------------------------------------------------
        | Chargement du chien
        |--------------------------------------------------------------------------
        */

        $deces->load('chien');



        /*
        |--------------------------------------------------------------------------
        | Création automatique de la perte
        |--------------------------------------------------------------------------
        */

        $perte = Perte::create([

            'type' => 'Décès',

            'source' => 'deces',

            'source_id' => $deces->id,

            'libelle' => "Décès du chien {$deces->chien->nom}",

            'montant' => $deces->chien->prix ?? 0,

            'description' => $deces->cause,

            'user_id' => Auth::id(),

        ]);



        /*
        |--------------------------------------------------------------------------
        | Notification perte créée
        |--------------------------------------------------------------------------
        */

        NotificationService::create(

            'Nouvelle perte enregistrée',

            "Une perte a été enregistrée : {$perte->libelle} d'un montant de "
            .number_format($perte->montant,0,',',' ')
            ." FCFA.",

            'danger',

            'perte',

            Auth::id()

        );



        /*
        |--------------------------------------------------------------------------
        | Notification décès
        |--------------------------------------------------------------------------
        */

        NotificationService::create(

            'Décès enregistré',

            "Le chien {$deces->chien->nom} est déclaré décédé.",

            'danger',

            'deces',

            Auth::id()

        );



        return redirect()

            ->route('deces.index')

            ->with(

                'success',

                'Décès enregistré'

            );
    }



    public function show(Deces $deces)
    {
        return view(
            'deces.show',
            compact('deces')
        );
    }



    public function edit(Deces $deces)
    {
        $chiens = Chien::all();


        return view(
            'deces.edit',
            compact(
                'deces',
                'chiens'
            )
        );
    }



    public function update(
        Request $request,
        Deces $deces
    )
    {
        $request->validate([

            'chien_id' => 'required',

            'date_deces' => 'required|date'

        ]);



        $deces->update($request->all());



        NotificationService::create(

            'Décès modifié',

            "Le décès #{$deces->id} a été modifié.",

            'warning',

            'deces',

            Auth::id()

        );



        return redirect()

            ->route('deces.index')

            ->with(

                'success',

                'Décès modifié'

            );
    }



    public function destroy(Deces $deces)
    {
        $id = $deces->id;


        /*
        Suppression de la perte liée
        */

        Perte::where('source','deces')
            ->where('source_id',$deces->id)
            ->delete();



        $deces->delete();



        NotificationService::create(

            'Décès supprimé',

            "Le décès #{$id} a été supprimé.",

            'danger',

            'deces',

            Auth::id()

        );



        return redirect()

            ->route('deces.index')

            ->with(

                'success',

                'Décès supprimé'

            );
    }
}