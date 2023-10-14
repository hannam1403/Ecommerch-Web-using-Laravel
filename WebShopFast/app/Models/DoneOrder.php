<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DoneOrder extends Model
{
    use HasFactory;
    private $deliveryOrdersSuccess;
    private $abortOrders;

    private function getDoneOrderData(){
        $user_id = Session::get('my_user_id');

        $deliveryOrdersSuccess =  DB::select("call getDeliveryOrderSuccess(:id)", 
        [
            "id" => $user_id
        ]);
        $abortOrders =  DB::select("call getAbortOrder(:id)", 
        [
            "id" => $user_id
        ]);

        $this->deliveryOrdersSuccess = $deliveryOrdersSuccess;
        $this->abortOrders = $abortOrders;

        return $this;
                                            
    }
}
