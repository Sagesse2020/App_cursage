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

        if($request->filled('search'))
        {
            $query->where(function($q) use ($request){

                $q->where('reference','like','%'.$request->search.'%')
                  ->orWhere('nom','like','%'.$request->search.'%')
                  ->orWhere('numero_puce','like','%'.$request->search.'%')
                  ->orWhere('numero_pedigree','like','%'.$request->search.'%');

            });
        }

        if($request->filled('race'))
        {
            $query->where('race_id',$request->race);
        }

        if($request->filled('sexe'))
        {
            $query->where('sexe',$request->sexe);
        }

        if($request->filled('statut'))
        {
            $query->where('statut',$request->statut);
        }

         if($request->filled('age'))
        {
            $query->where('age',$request->statut);
        }

        $chiens = $query
            ->latest()
            ->paginate(12)
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
        $races = Race::all();

        $partenaires = Partenaire::all();

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

            'nom'=>'nullable|string|max:100',

            'race_id'=>'required',

            'partenaire_id'=>'nullable',

            'prix_base'=>'required|numeric',

            'prix_vaccine'=>'nullable|numeric',

            'prix_dressage'=>'nullable|numeric',

            'date_arrive'=>'nullable|date',

            'date_naissance'=>'nullable|date',

            'poids'=>'nullable|numeric',

            'couleur'=>'nullable|string',

            'numero_puce'=>'nullable|string',

            'numero_pedigree'=>'nullable|string',

            'sexe'=>'nullable',

            'vacciné'=>'nullable',

            'dresse'=>'nullable',

            'provenance'=>'required',

            'statut'=>'required',
            
            'age'=>'required',

            'notes'=>'nullable|string',

            'photo'=>'nullable|image'

        ]);

        $data['reference'] =
        'DOG-'.Str::upper(Str::random(8));

        $data['vacciné'] =
        $request->has('vacciné');

        $data['dresse'] =
        $request->has('dresse');

        if($request->hasFile('photo'))
        {
            $data['photo'] =
            $request->file('photo')
            ->store('chiens','public');
        }

        Chien::create($data);

        return redirect()
        ->route('chiens.index')
        ->with(
            'success',
            'Chien enregistré avec succès'
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
        $races = Race::all();

        $partenaires = Partenaire::all();

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

            'nom'=>'nullable|string|max:100',

            'race_id'=>'required',

            'partenaire_id'=>'nullable',

            'prix_base'=>'required|numeric',

            'prix_vaccine'=>'nullable|numeric',

            'prix_dressage'=>'nullable|numeric',

            'date_arrive'=>'nullable|date',

            'date_naissance'=>'nullable|date',

            'poids'=>'nullable|numeric',

            'couleur'=>'nullable|string',

            'numero_puce'=>'nullable|string',

            'numero_pedigree'=>'nullable|string',

            'sexe'=>'nullable',

            'vacciné'=>'nullable',

            'dresse'=>'nullable',

            'provenance'=>'required',

            'statut'=>'required',

            'age'=>'required',

            'notes'=>'nullable|string',

            'photo'=>'nullable|image'

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
            $request->file('photo')
            ->store('chiens','public');
        }

        $chien->update($data);

        return redirect()
        ->route('chiens.index')
        ->with(
            'success',
            'Chien modifié avec succès'
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

        return back()
        ->with(
            'success',
            'Chien supprimé'
        );
    }
}