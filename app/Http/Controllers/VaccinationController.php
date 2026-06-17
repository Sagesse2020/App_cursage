
<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class VaccinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Vaccination::with([
            'chien',
            'user'
        ]);

        if($request->chien)
        {
            $query->whereHas(
                'chien',
                function($q) use($request)
                {
                    $q->where(
                        'nom',
                        'like',
                        '%'.$request->chien.'%'
                    );
                }
            );
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
        $chiens = Chien::orderBy('nom')->get();

        return view(
            'vaccinations.create',
            compact('chiens')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'chien_id'           => 'required|exists:chiens,id',
            'nom_vaccin'         => 'required|string|max:255',
            'date_vaccination'   => 'required|date',
            'date_rappel'        => 'nullable|date',
            'cout'               => 'nullable|numeric|min:0',
            'observation'        => 'nullable|string'

        ]);

        $data['user_id'] = Auth::id();

        $vaccination = Vaccination::create($data);

        $vaccination->load('chien');

        NotificationService::create(
            'Nouvelle vaccination',
            "Le chien {$vaccination->chien->nom} a reçu le vaccin {$vaccination->nom_vaccin}.",
            'success',
            'vaccination',
            auth()->id()
        );

        if($vaccination->date_rappel)
        {
            NotificationService::create(
                'Rappel vaccination programmé',
                "Un rappel du vaccin {$vaccination->nom_vaccin} est prévu pour {$vaccination->chien->nom}.",
                'info',
                'vaccination',
                auth()->id()
            );
        }

        return redirect()
            ->route('vaccinations.index')
            ->with(
                'success',
                'Vaccination enregistrée'
            );
    }

    public function show(Vaccination $vaccination)
    {
        $vaccination->load([
            'chien',
            'user'
        ]);

        return view(
            'vaccinations.show',
            compact('vaccination')
        );
    }

    public function edit(Vaccination $vaccination)
    {
        $chiens = Chien::orderBy('nom')->get();

        return view(
            'vaccinations.edit',
            compact(
                'vaccination',
                'chiens'
            )
        );
    }

    public function update(
        Request $request,
        Vaccination $vaccination
    )
    {
        $data = $request->validate([

            'chien_id'           => 'required|exists:chiens,id',
            'nom_vaccin'         => 'required|string|max:255',
            'date_vaccination'   => 'required|date',
            'date_rappel'        => 'nullable|date',
            'cout'               => 'nullable|numeric|min:0',
            'observation'        => 'nullable|string'

        ]);

        $vaccination->update($data);

        $vaccination->load('chien');

        NotificationService::create(
            'Vaccination modifiée',
            "La vaccination {$vaccination->nom_vaccin} du chien {$vaccination->chien->nom} a été modifiée.",
            'warning',
            'vaccination',
            auth()->id()
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
        $vaccination->load('chien');

        $nomChien = $vaccination->chien->nom;
        $vaccin = $vaccination->nom_vaccin;

        $vaccination->delete();

        NotificationService::create(
            'Vaccination supprimée',
            "La vaccination {$vaccin} du chien {$nomChien} a été supprimée.",
            'danger',
            'vaccination',
            auth()->id()
        );

        return redirect()
            ->route('vaccinations.index')
            ->with(
                'success',
                'Vaccination supprimée'
            );
    }
}
