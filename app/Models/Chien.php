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
        'notes',
        'age'
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

    public function vaccinations()
{
    return $this->hasMany(Vaccination::class);
}

public function traitements()
{
    return $this->hasMany(Traitement::class);
}

public function consultations()
{
    return $this->hasMany(
        ConsultationVeterinaire::class
    );
}

public function reproductionsMale()
{
    return $this->hasMany(
        Reproduction::class,
        'male_id'
    );
}

public function reproductionsFemelle()
{
    return $this->hasMany(
        Reproduction::class,
        'femelle_id'
    );
}

public function naissances()
{
    return $this->hasMany(
        Naissance::class
    );
}

public function reservations()
{
    return $this->hasMany(
        Reservation::class
    );
}
}
