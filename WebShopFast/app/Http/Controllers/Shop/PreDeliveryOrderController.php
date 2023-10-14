<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;
use App\Models\Order;

class PreDeliveryOrderController extends Controller
{
    public function index(Request $request){
        $preDeliveryOrders = new Order();
        $preDeliveryOrders = $preDeliveryOrders->getDataForPreDeliveryOrder($request->input('search'));

        return view('Shop.PreDeliveryOrder', compact('preDeliveryOrders'));
    }

    public function ChangeOrderStatusToDeliverySuccess($id){
        $preDeliveryOrders = new Order();
        $preDeliveryOrders = $preDeliveryOrders->ChangeOrderStatusToDeliverySuccess($id);
        return redirect()->back(); 
    }

    public function ChangeOrderStatusToDeliveryNotSuccess(Request $request){
        $preDeliveryOrders = new Order();
        $preDeliveryOrders = $preDeliveryOrders->ChangeOrderStatusToDeliveryNotSuccess($request);
        return redirect()->back();
    }
}
