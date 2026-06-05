<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    protected $fillable = [
        'chien_id',
        'nom_traitement',
        'date_debut',
        'date_fin',
        'cout',
        'description',
        'user_id',
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