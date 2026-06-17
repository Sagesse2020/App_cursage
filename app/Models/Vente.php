<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\NotificationService;

class Vente extends Model
{
     protected static function booted()
    {
        static::created(function ($vente) {

            NotificationService::create(
                'Nouvelle vente',
                "Une vente a été enregistrée (ID {$vente->id})",
                'success',
                'vente'
            );

        });
    }
     protected $fillable = [
        'chien_id', 'client_id','user_id', 'prix_vente',
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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
