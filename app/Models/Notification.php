<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\NotificationService;

class Notification extends Model
{
    protected $fillable = [

        'user_id',
        'titre',
        'message',
        'type',
        'lu'
    ];

       protected $casts = [

        'lu' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}