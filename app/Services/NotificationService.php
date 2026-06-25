<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function create($titre, $message, $type = 'info', $module = null, $userId = null)
    {
        Notification::create([
            'titre' => $titre,
            'message' => $message,
            'type' => $type,
            'module' => $module,
            'user_id' => $userId,
            'lu' => false
        ]);
    }
}
