<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Order;

class NotSuccessOrderController extends Controller
{
    public function index(Request $request){
        $deliveryOrdersNotSuccess = new Order();
        $deliveryOrdersNotSuccess = $deliveryOrdersNotSuccess->getDataForDeliveryNotSuccessOrder($request->input('search'));

        return view('Shop.NotSuccessOrder', compact('deliveryOrdersNotSuccess'));
    }
}
