<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [

        'reservation_id',
        'vente_id',
        'commande_id',
        'facture_id',
        'achat_id',

        'montant',
        'type',
        'mode_paiement',
        'statut',
        'date_paiement',
        'observation',

        'user_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }

    public function achat()
    {
        return $this->belongsTo(Achat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}