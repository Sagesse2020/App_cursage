<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CategorieController extends Controller
{
    // ================= INDEX =================

    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->niveau_admin >= 2) {

            $categories = Categorie::with('user')
                ->latest()
                ->paginate(12);

        } else {

            $categories = Categorie::with('user')
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(12);
        }

        return view('categories.index', compact('categories'));
    }

    // ================= CREATE =================

    public function create()
    {
        return view('categories.create');
    }

    // ================= STORE =================

    public function store(Request $request)
    {
        $data = $request->validate([

            'nom' => 'required|max:255',

            'description' => 'nullable'

        ]);

        $data['user_id'] = Auth::user()->id;

        Categorie::create($data);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée');
    }

    // ================= SHOW =================

    public function show(Categorie $categorie)
    {
        return view('categories.show', compact('categorie'));
    }

    // ================= EDIT =================

    public function edit(Categorie $categorie)
    {
        /** @var User $user */
        $user = Auth::user();

        if (
            $user->niveau_admin == 1
            &&
            $categorie->user_id != $user->id
        ) {

            abort(403);
        }

        return view('categories.edit', compact('categorie'));
    }

    // ================= UPDATE =================

    public function update(Request $request, Categorie $categorie)
    {
        /** @var User $user */
        $user = Auth::user();

        if (
            $user->niveau_admin == 1
            &&
            $categorie->user_id != $user->id
        ) {

            abort(403);
        }

        $data = $request->validate([

            'nom' => 'required|max:255',

            'description' => 'nullable'

        ]);

        $categorie->update($data);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie modifiée');
    }

    // ================= DELETE =================

    public function destroy(Categorie $categorie)
    {
        /** @var User $user */
        $user = Auth::user();

        if (
            $user->niveau_admin == 1
            &&
            $categorie->user_id != $user->id
        ) {

            abort(403);
        }

        $categorie->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée');
    }
}