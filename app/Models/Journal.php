<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',       // type d'action: création, modification, suppression
        'module',       // ex: Client, Chien, Gestion
        'auteur',       // user_id de celui qui fait l'action
        'description',  // détails
    ];

    public function user() {
        return $this->belongsTo(User::class, 'auteur');
    }
}
