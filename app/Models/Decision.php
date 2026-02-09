<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
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
