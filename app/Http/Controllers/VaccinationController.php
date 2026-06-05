<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;

use Illuminate\Http\Request;

class VaccinationController extends Controller
{
     public function index()
    {
        $vaccinations = Vaccination::with('chien')->latest()->get();
        return view('vaccinations.index', compact('vaccinations'));
    }

    public function create()
    {
        return view('vaccinations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'chien_id' => 'required',
            'vaccin' => 'required',
            'date_vaccination' => 'required|date',
            'prochaine_date' => 'nullable|date',
            'notes' => 'nullable'
        ]);

        Vaccination::create($data);

        return redirect()->route('vaccinations.index');
    }

    public function edit(Vaccination $vaccination)
    {
        return view('vaccinations.edit', compact('vaccination'));
    }

    public function update(Request $request, Vaccination $vaccination)
    {
        $vaccination->update($request->all());

        return redirect()->route('vaccinations.index');
    }

    public function destroy(Vaccination $vaccination)
    {
        $vaccination->delete();
        return back();
    }
}
