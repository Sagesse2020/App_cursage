<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementFournisseur extends Model
{
    protected $fillable = [

        'fournisseur_id',
        'montant',
        'date_paiement',
        'mode_paiement',
        'statut',
        'observation',
        'user_id'

    ];

    public function fournisseur()
    {
        return $this->belongsTo(
            Fournisseur::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
}