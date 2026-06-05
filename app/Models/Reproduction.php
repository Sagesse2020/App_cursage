<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reproduction extends Model
{
    protected $fillable = [
        'male_id',
        'femelle_id',
        'date_reproduction',
        'resultat',
        'observations',
        'user_id',
        'lignee_chien',
    ];

    public function male()
    {
        return $this->belongsTo(Chien::class, 'male_id');
    }

    public function femelle()
    {
        return $this->belongsTo(Chien::class, 'femelle_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}