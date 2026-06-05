<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = [

        'libelle',
        'description',
        'montant',
        'date_depense',
        'categorie',
        'justificatif',
        'user_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}