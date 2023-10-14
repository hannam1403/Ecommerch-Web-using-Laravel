<?php

namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class DetailShopController extends Controller
{
    //
    public function index() 
    {
        return view('Shop.DetailShop');
    }   

    public function update(Request $request, $id) 
    {
        $user = new Member();
        $user->updateDetailShop($request, $id);
        return view('Shop.DetailShop')->with('user', $user);
    }

    
    public function show($id) 
    {
        //dd("hien thi thong tin tu deal user thanh cong"); 
        $user = new Member();
        $user = $user->showDetailShop($id);
        return view('Shop.DetailShop')->with('user', $user);
    }

    public function withdraw(Request $request){
        $user = new Member();
        $user->withdrawDetailShop($request);
        return redirect()->back();
    }
}
