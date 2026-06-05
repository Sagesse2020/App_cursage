<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheSuivi extends Model
{
    protected $table = 'fiches_suivi';

    protected $fillable = [
        'chien_id',
        'poids',
        'temperature',
        'etat_general',
        'alimentation',
        'observation',
        'date_suivi',
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