<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VnpayPaymentController extends Controller
{
    public function SaveDeposit(Request $request) {
        $user = new Member();
        $user = $user->SaveDepositPayment($request);
        return redirect('/detailAccount')->with('user', $user);
    }

    public function VnpayPayment(Request $request) 
    {
        $user = new Member();
        $user = $user->VnpayPayment($request);
    }  

    public function SaveDeposit_Shop(Request $request) {
        $user = new Member();
        $user = $user->SaveDepositPayment_Shop($request);
        
        return view('Shop.DetailShop')->with('user', $user);
    }

    public function VnpayPayment_Shop(Request $request) 
    {
        $user = new Member();
        $user = $user->VnpayPayment_Shop($request);
    }  
}
