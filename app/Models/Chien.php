<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chien extends Model
{
    protected $fillable = [

        'reference',
        'nom',
        'race_id',
        'partenaire_id',
        'prix_base',
        'prix_vaccine',
        'prix_dressage',
        'vacciné',
        'dresse',
        'statut',
        'provenance',
        'photo',
        'date_arrive',
        'notes'

    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}
