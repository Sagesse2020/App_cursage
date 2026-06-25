<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use App\Models\Employee;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaireController extends Controller
{
    public function index()
    {
        $salaires = Salaire::with('employee')
            ->latest()
            ->paginate(12);

        return view('salaires.index', compact('salaires'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nom')->get();

        return view('salaires.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'mois' => 'required',
            'salaire_base' => 'required|numeric|min:0',
            'prime' => 'nullable|numeric|min:0',
            'retenue' => 'nullable|numeric|min:0',
            'statut' => 'required'
        ]);

        $prime = $request->prime ?? 0;
        $retenue = $request->retenue ?? 0;

        $net = $request->salaire_base + $prime - $retenue;

        $salaire = Salaire::create([
            'employee_id' => $request->employee_id,
            'mois' => $request->mois,
            'salaire_base' => $request->salaire_base,
            'prime' => $prime,
            'retenue' => $retenue,
            'montant_net' => $net,
            'statut' => $request->statut,
            'date_paiement' => $request->date_paiement,
        ]);

        NotificationService::create(
            'Salaire enregistré',
            "Salaire de {$net} FCFA enregistré pour un employé.",
            'success',
            'salaire',
            Auth::id()
        );

        return redirect()
            ->route('salaires.index')
            ->with('success', 'Salaire ajouté.');
    }

    public function show(Salaire $salaire)
    {
        return view('salaires.show', compact('salaire'));
    }

    public function edit(Salaire $salaire)
    {
        $employees = Employee::orderBy('nom')->get();

        return view('salaires.edit', compact('salaire', 'employees'));
    }

    public function update(Request $request, Salaire $salaire)
    {
        $request->validate([
            'salaire_base' => 'required|numeric|min:0',
            'prime' => 'nullable|numeric|min:0',
            'retenue' => 'nullable|numeric|min:0',
            'statut' => 'required'
        ]);

        $ancien = $salaire->montant_net;

        $prime = $request->prime ?? 0;
        $retenue = $request->retenue ?? 0;

        $net = $request->salaire_base + $prime - $retenue;

        $salaire->update([
            'employee_id' => $request->employee_id,
            'mois' => $request->mois,
            'salaire_base' => $request->salaire_base,
            'prime' => $prime,
            'retenue' => $retenue,
            'montant_net' => $net,
            'statut' => $request->statut,
            'date_paiement' => $request->date_paiement,
        ]);

        NotificationService::create(
            'Salaire modifié',
            "Salaire modifié de {$ancien} FCFA vers {$net} FCFA.",
            'warning',
            'salaire',
            Auth::id()
        );

        return redirect()
            ->route('salaires.index')
            ->with('success', 'Salaire modifié.');
    }

    public function destroy(Salaire $salaire)
    {
        $montant = $salaire->montant_net;

        $salaire->delete();

        NotificationService::create(
            'Salaire supprimé',
            "Salaire de {$montant} FCFA supprimé.",
            'danger',
            'salaire',
            Auth::id()
        );

        return redirect()
            ->route('salaires.index')
            ->with('success', 'Salaire supprimé.');
    }
}