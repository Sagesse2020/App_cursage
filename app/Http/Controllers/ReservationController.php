<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Chien;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\NotificationService;
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

    $reservation = Reservation::create([
        'chien_id' => $request->chien_id,
        'client_id' => $request->client_id,
        'date_reservation' => $request->date_reservation,
        'statut' => $request->statut,
        'montant_avance' => $request->montant_avance,
        'reste_a_payer' => $request->reste_a_payer,
        'user_id' => Auth::id(),
    ]);

    $reservation->load('chien','client');

    NotificationService::create(
        'Nouvelle réservation',
        "Le chien {$reservation->chien->nom} a été réservé par {$reservation->client->nom}.",
        'success',
        'reservation',
        Auth::id()
    );

    return redirect()
        ->route('reservations.index')
        ->with('success','Réservation ajoutée');
    }
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $chiens = Chien::all();
        $clients = Client::all();
        return view('reservations.edit', compact('reservation','chiens','clients'));
    }

    public function update(Request $request, Reservation $reservation)
{
    $ancienStatut = $reservation->statut;

    $reservation->update($request->all());

    $reservation->load('chien','client');

    NotificationService::create(
        'Réservation modifiée',
        "La réservation #{$reservation->id} a été modifiée.",
        'warning',
        'reservation',
        Auth::id()
    );

    if($ancienStatut != $reservation->statut)
    {
        NotificationService::create(
            'Changement de statut',
            "La réservation du chien {$reservation->chien->nom} est passée à : {$reservation->statut}.",
            'info',
            'reservation',
             Auth::id()
        );
    }

    if($reservation->statut == 'confirmée')
    {
        NotificationService::create(
            'Réservation confirmée',
            "La réservation du chien {$reservation->chien->nom} a été confirmée.",
            'success',
            'reservation',
             Auth::id()
        );
    }

    if($reservation->statut == 'annulée')
    {
        NotificationService::create(
            'Réservation annulée',
            "La réservation du chien {$reservation->chien->nom} a été annulée.",
            'danger',
            'reservation',
              Auth::id()
        );
    }

    return redirect()
        ->route('reservations.index')
        ->with('success','Réservation modifiée');
    }

     public function destroy(Reservation $reservation)
{
    $reservation->load('chien');

    $nomChien = $reservation->chien->nom;

    $reservation->delete();

    NotificationService::create(
        'Réservation supprimée',
        "La réservation du chien {$nomChien} a été supprimée.",
        'danger',
        'reservation',
         Auth::id()
    );

    return redirect()
        ->route('reservations.index')
        ->with('success','Réservation supprimée');
}
}