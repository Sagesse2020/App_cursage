<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'vente_id',
        'type',
        'montant',
        'destinataire',
        'date_transaction',
        'notes',
        'user_id'
    ];

    // Conversion automatique en objet date
    protected $casts = [
        'date_transaction' => 'datetime',
        'date_vente' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
