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
        'notes'
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    /* =========================
       Calcul des totaux
    ==========================*/

    public static function totalEntrees()
    {
        return self::whereIn('type', [
            'paiement_client',
            'versement_cursage'
        ])->sum('montant');
    }

    public static function totalSorties()
    {
        return self::where('type', 'paiement_partenaire')
            ->sum('montant');
    }

    public static function solde()
    {
        return self::totalEntrees() - self::totalSorties();
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
