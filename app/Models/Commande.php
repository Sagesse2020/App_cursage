<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
    'user_id',
    'produit_nom',
    'quantite',
    'prix_unitaire',
    'montant_total',
    'mode_paiement',
    'statut'
];

  // =========================
    // RELATION USER
    // =========================

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
