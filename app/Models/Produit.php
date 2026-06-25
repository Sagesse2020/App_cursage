<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [

        'nom',
        'description',
        'categorie_id',
        'prix_achat',
        'prix_vente',
        'stock',
        'unite',
        'photo',
        'user_id'

    ];

    // =========================
    // RELATION CATEGORIE
    // =========================

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // =========================
    // RELATION USER
    // =========================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commissions()
{
    return $this->hasMany(PartenaireCommission::class);
}
}