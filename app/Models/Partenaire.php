<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $fillable = [

        'nom',
        'prenom',
        'telephone',
        'email',
        'photo',
        'type_partenaire',
        'commission',
        'entreprise',
        'adresse',
        'statut'

    ];

    public function chiens()
    {
        return $this->hasMany(Chien::class);
    }

    public function user()
    {
         return $this->belongsTo(User::class);
    }

    public function commissions()
  {
    return $this->hasMany(PartenaireCommission::class);
  }

   public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public function users()
{
    return $this->hasMany(User::class);
}

}
