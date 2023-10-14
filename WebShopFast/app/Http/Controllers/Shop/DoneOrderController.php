<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Order;

class DoneOrderController extends Controller
{
    public function index(Request $request){
        $deliveryOrdersSuccess = new Order();
        $deliveryOrdersSuccess = $deliveryOrdersSuccess->getDataForDeliverySuccessOrder($request->input('search'));

        return view('Shop.DoneOrders', compact('deliveryOrdersSuccess'));
    }
}
