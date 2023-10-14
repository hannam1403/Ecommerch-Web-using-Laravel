<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;

class CustomerOrderController extends Controller
{
    public function index(){
        $customerorder = new CustomerOrder();
        $customerorder = $customerorder->getDataCustomerOrder();

        return view('Account.CustomerOrder')->with('orders',  $customerorder->orders)
                                            ->with('confirmOrders',  $customerorder->confirmOrders)
                                            ->with('preDeliveryOrders',  $customerorder->preDeliveryOrders)
                                            ->with('deliveryOrdersSuccess',  $customerorder->deliveryOrdersSuccess)
                                            ->with('abortOrders',  $customerorder->abortOrders);
    }

    public function show($id) 
    {
        $customerorder = new CustomerOrder();
        $customerorder = $customerorder->getDataToShow($id);

        return view('Account.CustomerOrder')->with('orders',   $customerorder->getOrders())
                                            ->with('confirmOrders',  $customerorder->getConfirmOrders())
                                            ->with('preDeliveryOrders',   $customerorder->getPreDeliveryOrders())
                                            ->with('deliveryOrdersSuccess',  $customerorder->getDeliveryOrdersSuccess())
                                            ->with('abortOrders',  $customerorder->getAbortOrders());
    }

    public function ChangeOrderStatusToAbort($id){
        $customerorder = new CustomerOrder();
        $customerorder = $customerorder->ChangeOrderStatusToAbort($id);
        return redirect()->back()->with('success', 'Order aborted successfully.'); 
    }
}
