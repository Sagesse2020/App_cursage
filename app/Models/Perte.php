<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perte extends Model
{
    protected $fillable = [

        'type',
        'source',
        'source_id',
        'libelle',
        'montant',
        'description',
        'user_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}