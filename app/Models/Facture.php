<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'numero',
        'vente_id',
        'client_id',
        'date',
        'total',
        'statut',
        'chemin_fichier',
        'type'
    ];

    protected $dates = ['date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }


    // Conversion automatique en objet date
    protected $casts = [
        'date' => 'datetime',
        'date_vente' => 'datetime',
        'created_at' => 'datetime',
    ];
}
