<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Order;

class AbortOrderController extends Controller
{
    public function index(Request $request){
        $abortOrders = new Order();
        $abortOrders = $abortOrders->getDataForAbortOrder($request->input('search'));
        return view('Shop.AbortOrders', compact('abortOrders'));
    }
}
