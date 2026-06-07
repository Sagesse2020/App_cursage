<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Chien;
use App\Models\Client;
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

    $query->whereHas('client', function($q) use ($request){

        $q->where('nom','like','%'.$request->client.'%');

    });

}
        $reservations = $query->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $chiens = Chien::all();
        $clients = Client::all();
        return view('reservations.create', compact('chiens','clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chien_id' => 'required',
            'client_id' => 'required',
            'date_reservation' => 'required',
        ]);

    Reservation::create([
    'chien_id' => $request->chien_id,
    'client_id' => $request->client_id,
    'date_reservation' => $request->date_reservation,
    'statut' => $request->statut,
    'montant_avance' => $request->montant_avance,
    'reste_a_payer' => $request->reste_a_payer,
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