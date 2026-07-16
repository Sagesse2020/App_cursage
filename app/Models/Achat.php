<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable = [

        'reference',
        'produit_id',
        'user_id',
        'quantite',
        'prix_unitaire',
        'montant_total',
        'date_achat',
        'fournisseur_id',
        'observation'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

        public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
