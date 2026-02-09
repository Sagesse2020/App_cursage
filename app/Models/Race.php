<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['nom', 'description'];

    public function chiens()
    {
        return $this->hasMany(Chien::class);
    }
}
