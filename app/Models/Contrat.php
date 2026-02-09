<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
       protected $fillable = [
        'titre',
        'contenu',
        'accord_elysee',
        'accord_associe',
        'date_signature',
        'statut',
    ];
}
