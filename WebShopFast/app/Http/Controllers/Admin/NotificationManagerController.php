<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationManagerController extends Controller
{
    public function index(){
        $notifications = new Notification();
        $notifications = $notifications->getNotificationData();
        return view('Admin.Notification')->with('notifications', $notifications);
    }

    public function doneNotification($id){
        $notifications = new Notification();
        $notifications->doneNotification($id);
        return redirect()->back();
    }
}
