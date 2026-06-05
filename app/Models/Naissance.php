<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Naissance extends Model
{
    protected $table = 'naissances';

    protected $fillable = [
        'reproduction_id',
        'date_naissance',
        'nombre_males',
        'nombre_femelles',
        'nombre_morts',
        'observation',
        'user_id',
    ];

    public function reproduction()
    {
        return $this->belongsTo(Reproduction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}