<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tresorerie extends Model
{
    use HasFactory;

     protected $table = 'tresoreries';

    public static function solde()
    {
        $entrees = self::sum('entrees'); // <-- ça pose problème
        $sorties = self::sum('sorties'); // <-- ça pose problème
        return $entrees - $sorties;
    }

    protected $fillable = [
        'type',       // entrée / sortie
        'montant',
        'description',
        'date_operation',
        'user_id',    // utilisateur qui a saisi
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
