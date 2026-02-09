<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
     protected $fillable = [
        'chien_id', 'client_id', 'prix_vente',
        'commission_partenaire', 'commission_cursage', 'date_vente'
    ];

    public function chien()
    {
        return $this->belongsTo(Chien::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
