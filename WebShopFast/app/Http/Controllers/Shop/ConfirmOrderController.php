<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;
use App\Models\Order;

class ConfirmOrderController extends Controller
{
    public function index(Request $request){
        $confirmOrders = new Order();
        $confirmOrders = $confirmOrders->getDataForConfirmOrder($request->input('search'));
        return view('Shop.ConfirmOrder', compact('confirmOrders'));
    }

    public function ChangeOrderStatusToPreDelivery($id){
        $confirmOrders = new Order();
        $confirmOrders = $confirmOrders->ChangeOrderStatusToPreDelivery($id);
        
        if($confirmOrders->getCheck() == null){
            return back()->with('error', 'Chưa chọn đơn vị vận chuyển cho đơn hàng');
        }
        else{
            DB::update('update billdetail set Status = 3 where Id = :Id', [
                "Id" => $id
            ]);
            return redirect()->back()->with('success', 'Đã chuyển trạng thái đơn hàng thành đang giao'); 
        }
    }
}
