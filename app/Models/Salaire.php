<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    protected $fillable = [

        'employee_id',
        'mois',
        'salaire_base',
        'prime',
        'retenue',
        'montant_net',
        'statut',
        'date_paiement'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
