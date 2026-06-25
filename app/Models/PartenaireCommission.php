<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartenaireCommission extends Model
{
    protected $fillable = [
        'partenaire_id',
        'produit_id',
        'chien_id',
        'pourcentage',
        'montant_fixe',
        'date_debut',
        'date_fin'
    ];

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function chien()
    {
        return $this->belongsTo(Chien::class);
    }
}