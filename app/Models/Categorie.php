<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'user_id'
    ];

    // Relation produits
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    // Créateur catégorie
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}