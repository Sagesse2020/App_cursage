<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activite extends Model
{
    protected $fillable = [

        'uuid',
        'user_id',
        'action',
        'module',
        'reference_id',
        'ancien_etat',
        'nouvel_etat',
        'severity',
        'is_system',
        'locked_at',
        'ip',
        'user_agent',

    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->uuid = Str::uuid();

            $model->locked_at = now();

        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | BLOQUER SUPPRESSION
    |--------------------------------------------------------------------------
    */

    public function delete()
    {
        throw new \Exception(
            'Suppression interdite'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BLOQUER UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(array $attributes = [], array $options = [])
    {
        throw new \Exception(
            'Modification interdite'
        );
    }
}