<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Chien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['chien','user'])->latest();

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        if ($request->client) {
            $query->where('client_nom', 'like', '%'.$request->client.'%');
        }

        $reservations = $query->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $chiens = Chien::all();
        return view('reservations.create', compact('chiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chien_id' => 'required',
            'client_nom' => 'required',
            'date_reservation' => 'required',
        ]);

        Reservation::create([
            'chien_id' => $request->chien_id,
            'client_nom' => $request->client_nom,
            'client_contact' => $request->client_contact,
            'date_reservation' => $request->date_reservation,
            'statut' => $request->statut,
            'montant_verse' => $request->montant_verse,
            'note' => $request->note,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('reservations.index')
            ->with('success','Réservation ajoutée');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $chiens = Chien::all();
        return view('reservations.edit', compact('reservation','chiens'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success','Réservation modifiée');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success','Réservation supprimée');
    }
}