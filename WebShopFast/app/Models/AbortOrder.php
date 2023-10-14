<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class AbortOrder extends Model
{
    use HasFactory;
    private $abortOrders;


    public function getDataForAbortOrder(){
        $user_id = Session::get('my_user_id');
        $abortOrders =  DB::select("call getAbortOrder(:id)", 
        [
            "id" => $user_id
        ]);

        return $abortOrders;
    }
}
