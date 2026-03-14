<?php

namespace App\Http\Controllers;

use App\Models\Chien;
use App\Models\Race;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChienController extends Controller
{

    public function index()
    {
        $chiens = Chien::with('race')->latest()->get();

        return view('chiens.index', compact('chiens'));
    }


    public function create()
    {
        $races = Race::all();
        $partenaires = Partenaire::all();
        $chiens = Chien::all();

        return view('chiens.create', compact('chiens','races','partenaires'));
    }


    public function store(Request $request)
    {

        $data = $request->validate([

            'nom'=>'nullable|string',

            'race_id'=>'required|exists:races,id',

            'partenaire_id'=>'nullable|exists:partenaires,id',

            'prix_base'=>'required|numeric',

            'prix_vaccine'=>'nullable|numeric',

            'prix_dressage'=>'nullable|numeric',

            'photo'=>'nullable|image',

            'date_arrive'=>'nullable|date',

            'notes'=>'nullable|string',

            'age'=>'nullable|string'
        ]);

        $data['reference'] = 'DOG-'.Str::upper(Str::random(6));

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('chiens','public');
        }

        Chien::create($data);

        return redirect()->route('chiens.index')
        ->with('success','Chien ajouté');
    }


    public function edit(Chien $chien)
    {
        $races = Race::all();
        $partenaires = Partenaire::all();

        return view('chiens.edit',compact(
            'chien','races','partenaires'
        ));
    }


    public function update(Request $request, Chien $chien)
    {

        $data = $request->validate([

            'nom'=>'nullable|string',

            'prix_base'=>'required|numeric',

            'prix_vaccine'=>'nullable|numeric',

            'prix_dressage'=>'nullable|numeric',

            'photo'=>'nullable|image',

            'notes'=>'nullable|string',

            'age'=>'nullable|string'

        ]);

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('chiens','public');
        }

        $chien->update($data);

        return redirect()->route('chiens.index');
    }

     public function show(Chien $chien)
    {
        return view('chiens.show', compact('chien'));
    }


    public function destroy(Chien $chien)
    {
        $chien->delete();

        return back();
    }
}
