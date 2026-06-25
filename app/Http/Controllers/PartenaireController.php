<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartenaireController extends Controller
{
    /**
     * Liste des partenaires
     */
    public function index()
    {
        $partenaires = Partenaire::latest()
            ->paginate(12);

        return view(
            'partenaires.index',
            compact('partenaires')
        );
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        return view('partenaires.create');
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'               => 'required|max:255',
            'prenom'            => 'nullable|max:255',
            'telephone'         => 'required|max:50',
            'email'             => 'nullable|email',
            'entreprise'        => 'nullable|max:255',
            'commission'        => 'required|numeric|min:0',
            'type_partenaire'   => 'required',
            'adresse'           => 'nullable',
            'statut'            => 'required',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $photo = null;

        if ($request->hasFile('photo'))
        {
            $photo = $request
                ->file('photo')
                ->store('partenaires', 'public');
        }

        $partenaire = Partenaire::create([

            'nom'               => $request->nom,
            'prenom'            => $request->prenom,
            'telephone'         => $request->telephone,
            'email'             => $request->email,
            'entreprise'        => $request->entreprise,
            'commission'        => $request->commission,
            'type_partenaire'   => $request->type_partenaire,
            'adresse'           => $request->adresse,
            'statut'            => $request->statut,
            'photo'             => $photo

        ]);

        NotificationService::create(
            'Nouveau partenaire',
            "Le partenaire {$partenaire->nom} {$partenaire->prenom} a été ajouté.",
            'success',
            'partenaire',
            Auth::id()
        );

        return redirect()
            ->route('partenaires.index')
            ->with(
                'success',
                'Partenaire ajouté avec succès.'
            );
    }

    /**
     * Affichage
     */
    public function show(Partenaire $partenaire)
    {
        return view(
            'partenaires.show',
            compact('partenaire')
        );
    }

    /**
     * Formulaire modification
     */
    public function edit(Partenaire $partenaire)
    {
        return view(
            'partenaires.edit',
            compact('partenaire')
        );
    }

    /**
     * Mise à jour
     */
    public function update(
        Request $request,
        Partenaire $partenaire
    )
    {
        $ancienStatut = $partenaire->statut;

        $request->validate([
            'nom'               => 'required|max:255',
            'prenom'            => 'nullable|max:255',
            'telephone'         => 'required|max:50',
            'email'             => 'nullable|email',
            'entreprise'        => 'nullable|max:255',
            'commission'        => 'required|numeric|min:0',
            'type_partenaire'   => 'required',
            'adresse'           => 'nullable',
            'statut'            => 'required',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('photo'))
        {
            if (
                $partenaire->photo &&
                Storage::disk('public')->exists($partenaire->photo)
            ) {
                Storage::disk('public')
                    ->delete($partenaire->photo);
            }

            $partenaire->photo = $request
                ->file('photo')
                ->store('partenaires', 'public');
        }

        $partenaire->nom               = $request->nom;
        $partenaire->prenom            = $request->prenom;
        $partenaire->telephone         = $request->telephone;
        $partenaire->email             = $request->email;
        $partenaire->entreprise        = $request->entreprise;
        $partenaire->commission        = $request->commission;
        $partenaire->type_partenaire   = $request->type_partenaire;
        $partenaire->adresse           = $request->adresse;
        $partenaire->statut            = $request->statut;

        $partenaire->save();

        NotificationService::create(
            'Partenaire modifié',
            "Le partenaire {$partenaire->nom} {$partenaire->prenom} a été modifié.",
            'warning',
            'partenaire',
            Auth::id()
        );

        if (
            $ancienStatut != 'actif'
            &&
            $partenaire->statut == 'actif'
        ) {
            NotificationService::create(
                'Partenaire activé',
                "{$partenaire->nom} {$partenaire->prenom} est désormais actif.",
                'success',
                'partenaire',
                Auth::id()
            );
        }

        if (
            $ancienStatut != 'suspendu'
            &&
            $partenaire->statut == 'suspendu'
        ) {
            NotificationService::create(
                'Partenaire suspendu',
                "{$partenaire->nom} {$partenaire->prenom} a été suspendu.",
                'danger',
                'partenaire',
                Auth::id()
            );
        }

        return redirect()
            ->route('partenaires.index')
            ->with(
                'success',
                'Partenaire modifié avec succès.'
            );
    }

    /**
     * Suppression
     */
    public function destroy(Partenaire $partenaire)
    {
        $nomComplet =
            $partenaire->nom . ' ' .
            $partenaire->prenom;

        if (
            $partenaire->photo &&
            Storage::disk('public')->exists($partenaire->photo)
        ) {
            Storage::disk('public')
                ->delete($partenaire->photo);
        }

        $partenaire->delete();

        NotificationService::create(
            'Partenaire supprimé',
            "Le partenaire {$nomComplet} a été supprimé.",
            'danger',
            'partenaire',
            Auth::id()
        );

        return redirect()
            ->route('partenaires.index')
            ->with(
                'success',
                'Partenaire supprimé.'
            );
    }
}