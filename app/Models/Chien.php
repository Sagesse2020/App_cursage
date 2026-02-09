<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chien extends Model
{
    protected $fillable = [
        'nom_chien', 'race_id', 'partenaire_id', 'prix_base',
        'prix_vacciné', 'prix_dressé', 'vacciné', 'dressé',
        'statut', 'photo', 'date_arrivée'
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function vente()
    {
        return $this->hasOne(Vente::class);
    }
}
