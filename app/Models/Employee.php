<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [

        'nom',
        'prenom',
        'telephone',
        'email',
        'poste',
        'salaire',
        'date_embauche',
        'photo',
        'statut',
        'adresse',

    ];

    /*
    |--------------------------------------------------------------------------
    | LOGS AUTOMATIQUES
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
    }
      }