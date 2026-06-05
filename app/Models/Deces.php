<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deces extends Model
{
    protected $table = 'deces';

    protected $fillable = [
        'chien_id',
        'cause',
        'date_deces',
        'observation',
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