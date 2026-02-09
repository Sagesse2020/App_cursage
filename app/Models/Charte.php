<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charte extends Model
{

    protected $fillable = [
        'titre',
        'contenu',
        'date_signature',
        'signe_elysee',
        'signe_associe',
        'statut',
    ];
}
