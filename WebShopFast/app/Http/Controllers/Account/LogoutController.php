<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush(); 
        return redirect()->route('MainWeb'); 
    }
}