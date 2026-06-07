<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'chien_id',
    'client_id',
    'date_reservation',
    'statut',
    'montant_avance',
    'reste_a_payer',
    'user_id',
    ];

    public function chien()
    {
        return $this->belongsTo(Chien::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}