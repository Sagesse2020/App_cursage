<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Chien;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * LISTE
     */
    public function index()
    {
        $consultations = Consultation::with(['chien', 'user'])
            ->latest()
            ->paginate(10);

        return view('consultations.index', compact('consultations'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $chiens = Chien::orderBy('nom')->get();

        return view('consultations.create', compact('chiens'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'chien_id' => 'required|exists:chiens,id',
            'date_consultation' => 'required|date',
            'veterinaire' => 'required|max:255',
            'diagnostic' => 'required',
            'prescription' => 'nullable',
            'cout' => 'required|numeric'
        ]);

        $data['user_id'] = Auth::id();

        $consultation = Consultation::create($data);

        // 🔔 NOTIFICATION
        Notification::create([
            'titre' => 'Nouvelle consultation',
            'message' => 'Consultation ajoutée pour le chien ID ' . $consultation->chien_id,
            'type' => 'success',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('consultations.index')
            ->with('success', 'Consultation enregistrée');
    }

    /**
     * SHOW
     */
    public function show(Consultation $consultation)
    {
        $consultation->load(['chien', 'user']);

        return view('consultations.show', compact('consultation'));
    }

    /**
     * EDIT
     */
    public function edit(Consultation $consultation)
    {
        $chiens = Chien::orderBy('nom')->get();

        return view('consultations.edit', compact('consultation', 'chiens'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Consultation $consultation)
    {
        $data = $request->validate([
            'chien_id' => 'required|exists:chiens,id',
            'date_consultation' => 'required|date',
            'veterinaire' => 'required|max:255',
            'diagnostic' => 'required',
            'prescription' => 'nullable',
            'cout' => 'required|numeric'
        ]);

        $consultation->update($data);

        // 🔔 NOTIFICATION
        Notification::create([
            'titre' => 'Consultation modifiée',
            'message' => 'Consultation #' . $consultation->id . ' a été modifiée',
            'type' => 'info',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('consultations.index')
            ->with('success', 'Consultation mise à jour');
    }

    /**
     * DELETE
     */
    public function destroy(Consultation $consultation)
    {
        $id = $consultation->id;

        $consultation->delete();

        // 🔔 NOTIFICATION
        Notification::create([
            'titre' => 'Consultation supprimée',
            'message' => 'Consultation #' . $id . ' supprimée avec succès',
            'type' => 'danger',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('consultations.index')
            ->with('success', 'Consultation supprimée');
    }
}