<?php

namespace App\Http\Controllers;

use App\Models\Chien;
use App\Models\Race;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChienController extends Controller
{
    public function index(Request $request)
    {
        $query = Chien::with([
            'race',
            'partenaire'
        ]);

        // Recherche globale
        if($request->filled('search'))
        {
            $query->where(function($q) use ($request){

                $q->where('reference','like','%'.$request->search.'%')
                  ->orWhere('nom','like','%'.$request->search.'%')
                  ->orWhere('numero_puce','like','%'.$request->search.'%')
                  ->orWhere('numero_pedigree','like','%'.$request->search.'%');
            });
        }

        // Race
        if($request->filled('race'))
        {
            $query->where('race_id',$request->race);
        }

        // Sexe
        if($request->filled('sexe'))
        {
            $query->where('sexe',$request->sexe);
        }

        // Statut
        if($request->filled('statut'))
        {
            $query->where('statut',$request->statut);
        }

        // Provenance
        if($request->filled('provenance'))
        {
            $query->where('provenance',$request->provenance);
        }

        // Age
        if($request->filled('age'))
        {
            $query->where('age',$request->age);
        }

        $chiens = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $races = Race::orderBy('nom')->get();

        return view(
            'chiens.index',
            compact(
                'chiens',
                'races'
            )
        );
    }

    public function create()
    {
        $races = Race::orderBy('nom')->get();

        $partenaires = Partenaire::orderBy('nom')->get();

        return view(
            'chiens.create',
            compact(
                'races',
                'partenaires'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'nom'               => 'nullable|string|max:100',
            'race_id'           => 'required|exists:races,id',
            'partenaire_id'     => 'nullable|exists:partenaires,id',

            'prix_base'         => 'required|numeric|min:0',
            'prix_vaccine'      => 'nullable|numeric|min:0',
            'prix_dressage'     => 'nullable|numeric|min:0',

            'date_arrive'       => 'nullable|date',
            'date_naissance'    => 'nullable|date',

            'poids'             => 'nullable|numeric|min:0',

            'couleur'           => 'nullable|string|max:100',

            'numero_puce'       => 'nullable|string|max:255|unique:chiens,numero_puce',

            'numero_pedigree'   => 'nullable|string|max:255',

            'sexe'              => 'nullable|in:male,femelle',

            'provenance'        => 'required|in:cursage,partenaire',

            'statut'            => 'required|in:disponible,reserve,vendu,en_soins',

            'age'               => 'required|string|max:50',

            'notes'             => 'nullable|string',

            'photo'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data['reference'] =
        'DOG-' . strtoupper(Str::random(8));

        $data['vacciné'] =
        $request->has('vacciné');

        $data['dresse'] =
        $request->has('dresse');

        if($request->hasFile('photo'))
        {
            $data['photo'] =
            $request
                ->file('photo')
                ->store('chiens','public');
        }

        Chien::create($data);

        return redirect()
            ->route('chiens.index')
            ->with(
                'success',
                'Chien enregistré avec succès.'
            );
    }

    public function show(Chien $chien)
    {
        return view(
            'chiens.show',
            compact('chien')
        );
    }

    public function edit(Chien $chien)
    {
        $races = Race::orderBy('nom')->get();

        $partenaires = Partenaire::orderBy('nom')->get();

        return view(
            'chiens.edit',
            compact(
                'chien',
                'races',
                'partenaires'
            )
        );
    }

    public function update(
        Request $request,
        Chien $chien
    )
    {
        $data = $request->validate([

            'nom'               => 'nullable|string|max:100',
            'race_id'           => 'required|exists:races,id',
            'partenaire_id'     => 'nullable|exists:partenaires,id',

            'prix_base'         => 'required|numeric|min:0',
            'prix_vaccine'      => 'nullable|numeric|min:0',
            'prix_dressage'     => 'nullable|numeric|min:0',

            'date_arrive'       => 'nullable|date',
            'date_naissance'    => 'nullable|date',

            'poids'             => 'nullable|numeric|min:0',

            'couleur'           => 'nullable|string|max:100',

            'numero_puce'       => 'nullable|unique:chiens,numero_puce,'.$chien->id,

            'numero_pedigree'   => 'nullable|string|max:255',

            'sexe'              => 'nullable|in:male,femelle',

            'provenance'        => 'required|in:cursage,partenaire',

            'statut'            => 'required|in:disponible,reserve,vendu,en_soins',

            'age'               => 'required|string|max:50',

            'notes'             => 'nullable|string',

            'photo'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data['vacciné'] =
        $request->has('vacciné');

        $data['dresse'] =
        $request->has('dresse');

        if($request->hasFile('photo'))
        {
            if($chien->photo)
            {
                Storage::disk('public')
                    ->delete($chien->photo);
            }

            $data['photo'] =
            $request
                ->file('photo')
                ->store('chiens','public');
        }

        $chien->update($data);

        return redirect()
            ->route('chiens.index')
            ->with(
                'success',
                'Chien modifié avec succès.'
            );
    }

    public function destroy(Chien $chien)
    {
        if($chien->photo)
        {
            Storage::disk('public')
                ->delete($chien->photo);
        }

        $chien->delete();

        return redirect()
            ->route('chiens.index')
            ->with(
                'success',
                'Chien supprimé.'
            );
    }
}