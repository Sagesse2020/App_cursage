<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()
                        ->paginate(20);

        return view(
            'notifications.index',
            compact('notifications')
        );
    }

    public function read(Notification $notification)
    {
        $notification->update([
            'lu' => true
        ]);

        return back();
    }
}