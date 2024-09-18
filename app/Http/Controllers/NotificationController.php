<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $auth_user_id = Auth::user()->id;
        $notifications = User::find($auth_user_id)->notifications;
        return view('notifications',
            [
                "notifications" =>  $notifications,
            ]
    );
    }
}
