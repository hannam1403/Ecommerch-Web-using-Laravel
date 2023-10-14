<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    use HasFactory;

    private $Id;
    private $IdAboutMember;
    private $Content;
    private $Create_at;
    private $Status;
    
    public function getNotificationData(){
        $notifications = DB::table('notification')
                    ->where('Status', '=', 1)
                    ->get();
        return $notifications;
    }

    public function doneNotification($Id){
        DB::update('update notification set Status = 0 where Id = :Id', [
            'Id' => $Id
        ]);
    }

}
