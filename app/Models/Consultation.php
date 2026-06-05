<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //PRECISER A LARAVEL que le modele Consultation est lié à la table consultations_veterinaires
    protected $table = 'consultations_veterinaires';

    protected $fillable = [
        'chien_id',
        'date_consultation',
        'veterinaire',
        'diagnostic',
        'prescription',
        'cout',
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