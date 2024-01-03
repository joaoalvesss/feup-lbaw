<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id){
        $user = auth()->user();

        $notification = $user->notifications()->find($id);

        if($notification){
            $notification->markAsRead();
        }

        return back();
    }
}
