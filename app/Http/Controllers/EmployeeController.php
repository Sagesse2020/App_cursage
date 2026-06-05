<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $employees = Employee::latest()->get();

        return view(
            'employees.index',
            compact('employees')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('employees.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nom' => 'required',

            'prenom' => 'required',

            'telephone' => 'nullable',

            'email' => 'nullable|email',

            'poste' => 'required',

            'salaire' => 'required|numeric',

            'date_embauche' => 'required|date',

            'photo' => 'nullable|image',

            'statut' => 'required',

            'adresse' => 'nullable',

        ]);

        $photo = null;

        if($request->hasFile('photo')){

            $photo = $request
                ->file('photo')
                ->store(
                    'employees',
                    'public'
                );
        }

        Employee::create([

            'nom' => $request->nom,

            'prenom' => $request->prenom,

            'telephone' => $request->telephone,

            'email' => $request->email,

            'poste' => $request->poste,

            'salaire' => $request->salaire,

            'date_embauche' => $request->date_embauche,

            'photo' => $photo,

            'statut' => $request->statut,

            'adresse' => $request->adresse,

        ]);

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Employé ajouté avec succès'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Employee $employee)
    {
        return view(
            'employees.show',
            compact('employee')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with(
            'success',
            'Employé supprimé'
        );
    }

        /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
{
    $employee = \App\Models\Employee::findOrFail($id);

    return view('employees.edit', compact('employees'));
}

public function update(
    Request $request,
    Employee $employee
)
{
    $data = $request->validate([

        'nom' => 'required|max:255',

        'prenom' => 'required|max:255',

        'telephone' => 'nullable|max:30',

        'email' => 'nullable|email',

        'poste' => 'required|max:255',

        'salaire' => 'required|numeric|min:0',

        'date_embauche' => 'required|date',

        'statut' => 'required|in:actif,suspendu,demission',

        'adresse' => 'nullable',

        'photo' => 'nullable|image|max:4096',

    ]);

    if ($request->hasFile('photo')) {

        if (
            $employee->photo &&
            Storage::disk('public')
                ->exists($employee->photo)
        ) {

            Storage::disk('public')
                ->delete($employee->photo);
        }

        $data['photo'] = $request
            ->file('photo')
            ->store(
                'employees',
                'public'
            );
    }

    $employee->update($data);

    return redirect()
        ->route('employees.index')
        ->with(
            'success',
            'Employé modifié avec succès.'
        );
}
}