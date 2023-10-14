<?php

namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(){
        return view('Shop.shopHome');
    }

}
