<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = [

        'chien_id',
        'nom_vaccin',
        'date_vaccination',
        'date_rappel',
        'cout',
        'observation',
        'user_id'
    ];

    public function chien()
    {
        return $this->belongsTo(Chien::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}