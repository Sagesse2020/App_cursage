<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function index(Request $request, Notification $notification)
{
    $query = Notification::query();

    if($request->search)
    {
        $query->where(function($q) use($request){

            $q->where('titre','like','%'.$request->search.'%')
              ->orWhere('message','like','%'.$request->search.'%');

        });
    }

    if($request->type)
    {
        $query->where('type',$request->type);
    }

    if($request->lu !== null && $request->lu !== '')
    {
        $query->where('lu',$request->lu);
    }

    $notifications = $query
        ->latest()
        ->paginate(15);

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

     public function destroy(Notification $notification)
    {
        $notification->delete();

        return back()->with('success','Notification supprimée');
    }
}