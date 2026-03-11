<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'password',
        'adresse'
    ];

    protected $hidden = [
        'password'
    ];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

}

