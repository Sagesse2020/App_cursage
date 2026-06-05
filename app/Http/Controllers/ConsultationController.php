<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Chien;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $consultations = Consultation::with(['chien','user'])->latest()->paginate(10);

    return view('consultations.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chiens = Chien::orderBy('nom')->get();
    return view(
        'consultations.create', compact('chiens')
    );
    }

    /**
     * Store a newly created resource in storage.
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

    Consultation::create($data);

    return redirect()
        ->route('consultations.index')
        ->with('success', 'Consultation enregistrée');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
