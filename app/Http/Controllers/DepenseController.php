<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Depense::latest()
            ->paginate(10);

        return view(
            'depenses.index',
            compact('depenses')
        );
    }

    public function create()
    {
        return view('depenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'libelle'=>'required',
            'description'=>'nullable',
            'montant'=>'required|numeric|min:0',
            'date_depense'=>'required|date',
            'categorie'=>'required',
            'justificatif'=>'nullable|image'

        ]);

        if($request->hasFile('justificatif'))
        {
            $data['justificatif'] =
                $request->file('justificatif')
                ->store(
                    'depenses',
                    'public'
                );
        }

        $data['user_id']=Auth::id();

        Depense::create($data);

        return redirect()
            ->route('depenses.index')
            ->with(
                'success',
                'Dépense enregistrée'
            );
    }

    public function show(Depense $depense)
    {
        return view(
            'depenses.show',
            compact('depense')
        );
    }

    public function edit(Depense $depense)
    {
        return view(
            'depenses.edit',
            compact('depense')
        );
    }

    public function update(
        Request $request,
        Depense $depense
    )
    {
        $data = $request->validate([

            'libelle'=>'required',
            'description'=>'nullable',
            'montant'=>'required|numeric|min:0',
            'date_depense'=>'required|date',
            'categorie'=>'required',
            'justificatif'=>'nullable|image'

        ]);

        if($request->hasFile('justificatif'))
        {
            if($depense->justificatif)
            {
                Storage::disk('public')
                    ->delete(
                        $depense->justificatif
                    );
            }

            $data['justificatif'] =
                $request->file('justificatif')
                ->store(
                    'depenses',
                    'public'
                );
        }

        $depense->update($data);

        return redirect()
            ->route('depenses.index')
            ->with(
                'success',
                'Dépense modifiée'
            );
    }

    public function destroy(
        Depense $depense
    )
    {
        if($depense->justificatif)
        {
            Storage::disk('public')
                ->delete(
                    $depense->justificatif
                );
        }

        $depense->delete();

        return back()->with(
            'success',
            'Dépense supprimée'
        );
    }
}