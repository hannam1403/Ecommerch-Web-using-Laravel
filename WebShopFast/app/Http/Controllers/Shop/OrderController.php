<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request){
        $order = new Order();
        $orders = $order->getDataForNewOrder($request->input('search'));

        return view('Shop.NewOrderManager', compact('orders'));
    }

    public function ChangeOrderStatusToApprove($id){
        $order = new Order();
        $order = $order->ChangeOrderStatusToApprove($id);
        return redirect()->back()->with('success', 'Đã xác nhận đơn hàng'); 
    }

    public function ChangeOrderStatusToPreDelivery($id){
        $order = new Order();
        $order = $order->ChangeOrderStatusToPreDelivery($id);
        
        if($order->getCheck() == null){
            return back()->with('error', 'Chưa chọn đơn vị vận chuyển cho đơn hàng');
        }
        else{
            DB::update('update billdetail set Status = 3 where Id = :Id', [
                "Id" => $id
            ]);
            return redirect()->back()->with('success', 'Đã chuyển trạng thái đơn hàng thành đang giao'); 
        }
    }

    public function ChangeOrderStatusToDeliverySuccess($id){
        $order = new Order();
        $order = $order->ChangeOrderStatusToDeliverySuccess($id);
        return redirect()->back()->with('success', 'Đơn hàng đã giao thành công'); 
    }

    public function ChangeOrderStatusToAbort($id){
        $order = new Order();
        $order = $order->ChangeOrderStatusToAbort($id);
        return redirect()->back()->with('success', 'Order aborted successfully.'); 
    }

    public function ChangeOrderStatusToDeliveryNotSuccess(Request $request){
        $order = new Order();
        $order = $order->ChangeOrderStatusToDeliveryNotSuccess($request);
        return redirect()->back();
    }

}
