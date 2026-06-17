```php
<?php

namespace App\Http\Controllers;

use App\Models\Naissance;
use App\Models\Reproduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class NaissanceController extends Controller
{
    public function index()
    {
        $naissances = Naissance::with('reproduction')
            ->latest()
            ->paginate(10);

        return view('naissances.index', compact('naissances'));
    }

    public function create()
    {
        $reproductions = Reproduction::with([
            'male',
            'femelle'
        ])->get();

        return view(
            'naissances.create',
            compact('reproductions')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'reproduction_id' => 'required',
            'date_naissance' => 'required|date',
        ]);

        $naissance = Naissance::create([
            'reproduction_id' => $request->reproduction_id,
            'date_naissance' => $request->date_naissance,
            'nombre_males' => $request->nombre_males,
            'nombre_femelles' => $request->nombre_femelles,
            'nombre_morts' => $request->nombre_morts,
            'observation' => $request->observation,
            'user_id' => Auth::id(),
        ]);

        $total =
            ($naissance->nombre_males ?? 0)
            +
            ($naissance->nombre_femelles ?? 0);

        NotificationService::create(
            'Nouvelle naissance',
            "{$total} chiots sont nés.",
            'success',
            'naissance',
            auth()->id()
        );

        if(($naissance->nombre_morts ?? 0) > 0)
        {
            NotificationService::create(
                'Alerte naissance',
                "{$naissance->nombre_morts} chiot(s) mort(s) à la naissance.",
                'danger',
                'naissance',
                auth()->id()
            );
        }

        return redirect()
            ->route('naissances.index')
            ->with(
                'success',
                'Naissance enregistrée'
            );
    }

    public function show(Naissance $naissance)
    {
        return view(
            'naissances.show',
            compact('naissance')
        );
    }

    public function edit(Naissance $naissance)
    {
        $reproductions = Reproduction::with([
            'male',
            'femelle'
        ])->get();

        return view(
            'naissances.edit',
            compact(
                'naissance',
                'reproductions'
            )
        );
    }

    public function update(
        Request $request,
        Naissance $naissance
    )
    {
        $request->validate([
            'reproduction_id' => 'required',
            'date_naissance' => 'required'
        ]);

        $naissance->update($request->all());

        NotificationService::create(
            'Naissance modifiée',
            "La naissance #{$naissance->id} a été modifiée.",
            'warning',
            'naissance',
            auth()->id()
        );

        return redirect()
            ->route('naissances.index')
            ->with(
                'success',
                'Naissance modifiée'
            );
    }

    public function destroy(Naissance $naissance)
    {
        $id = $naissance->id;

        $naissance->delete();

        NotificationService::create(
            'Naissance supprimée',
            "La naissance #{$id} a été supprimée.",
            'danger',
            'naissance',
            auth()->id()
        );

        return redirect()
            ->route('naissances.index')
            ->with(
                'success',
                'Naissance supprimée'
            );
    }
}
