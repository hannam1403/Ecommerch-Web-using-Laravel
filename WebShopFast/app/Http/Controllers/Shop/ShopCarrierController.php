<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\ShopCarrier;

class ShopCarrierController extends Controller
{
    public function index(Request $request){
        $shopcarrier = new ShopCarrier();
        $shopcarrier = $shopcarrier->getDataForShopCarrier($request->input('search'));
        return view('Shop.ShopCarrier')->with("carriers", $shopcarrier->getCarriers()->paginate(10))->with("options", $shopcarrier->getOptions());
    }

    public function ChangeCarrier(Request $request, $id)
    {
        $shopcarrier = new ShopCarrier();
        $shopcarrier = $shopcarrier->ChangeCarrier($request, $id);
        return redirect()->back();
    }

}
