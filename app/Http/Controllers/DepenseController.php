<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\NotificationService;

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

            'libelle'        => 'required',
            'description'    => 'nullable',
            'montant'        => 'required|numeric|min:0',
            'date_depense'   => 'required|date',
            'categorie'      => 'required',
            'justificatif'   => 'nullable|image'

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

        $data['user_id'] = Auth::id();

        $depense = Depense::create($data);

        NotificationService::create(
            'Nouvelle dépense',
            "Une dépense de ".number_format($depense->montant,0,',',' ')." FCFA a été enregistrée.",
            'warning',
            'finance',
            Auth::id()
        );

        if($depense->montant >= 100000)
        {
            NotificationService::create(
                'Dépense importante',
                "Une dépense élevée de ".number_format($depense->montant,0,',',' ')." FCFA a été détectée.",
                'danger',
                'finance',
                Auth::id()
            );
        }

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

            'libelle'        => 'required',
            'description'    => 'nullable',
            'montant'        => 'required|numeric|min:0',
            'date_depense'   => 'required|date',
            'categorie'      => 'required',
            'justificatif'   => 'nullable|image'

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

        NotificationService::create(
            'Dépense modifiée',
            "La dépense {$depense->libelle} a été modifiée.",
            'info',
            'finance',
            Auth::id()
        );

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

        $libelle = $depense->libelle;

        $depense->delete();

        NotificationService::create(
            'Dépense supprimée',
            "La dépense {$libelle} a été supprimée.",
            'danger',
            'finance',
             Auth::id()
        );

        return back()->with(
            'success',
            'Dépense supprimée'
        );
    }
}
