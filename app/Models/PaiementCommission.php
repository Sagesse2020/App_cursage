<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementCommission extends Model
{
    protected $fillable = [

        'partenaire_id',
        'partenaire_commission_id',
        'montant',
        'date_paiement',
        'mode_paiement',
        'statut',
        'observation',
        'user_id'
    ];

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function commission()
    {
        return $this->belongsTo(
            PartenaireCommission::class,
            'partenaire_commission_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
