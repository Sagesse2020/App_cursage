<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Vaccination::with('chien');

        if($request->chien)
        {
            $query->whereHas('chien',function($q) use($request){

                $q->where(
                    'nom',
                    'like',
                    '%'.$request->chien.'%'
                );
            });
        }

        $vaccinations = $query
                        ->latest()
                        ->paginate(10);

        return view(
            'vaccinations.index',
            compact('vaccinations')
        );
    }

    public function create()
    {
        $chiens = Chien::all();

        return view(
            'vaccinations.create',
            compact('chiens')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'chien_id'=>'required',
            'nom_vaccin'=>'required',
            'date_vaccination'=>'required',
        ]);

        Vaccination::create([

            'chien_id'=>$request->chien_id,
            'nom_vaccin'=>$request->nom_vaccin,
            'date_vaccination'=>$request->date_vaccination,
            'date_rappel'=>$request->date_rappel,
            'cout'=>$request->cout,
            'observation'=>$request->observation,
            'user_id'=>Auth::id(),
        ]);

        return redirect()
            ->route('vaccinations.index')
            ->with(
                'success',
                'Vaccination enregistrée'
            );
    }

    public function show(Vaccination $vaccination)
    {
        return view(
            'vaccinations.show',
            compact('vaccination')
        );
    }

    public function edit(Vaccination $vaccination)
    {
        $chiens = Chien::all();

        return view(
            'vaccinations.edit',
            compact(
                'vaccination',
                'chiens'
            )
        );
    }

    public function update(Request $request,
                           Vaccination $vaccination)
    {
        $vaccination->update(
            $request->all()
        );

        return redirect()
            ->route('vaccinations.index')
            ->with(
                'success',
                'Vaccination modifiée'
            );
    }

    public function destroy(
        Vaccination $vaccination
    )
    {
        $vaccination->delete();

        return redirect()
            ->route('vaccinations.index')
            ->with(
                'success',
                'Vaccination supprimée'
            );
    }
}