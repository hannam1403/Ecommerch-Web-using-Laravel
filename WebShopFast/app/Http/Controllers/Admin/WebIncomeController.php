<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebIncomeController extends Controller
{
    public function index(){
        $webincomes = DB::table('webincome')
        ->paginate(10);
        return view('Admin.WebIncome', compact('webincomes'));
    }

    public function search(Request $request){
        $var_search = $request->query('var_search');
        $webincomes = DB::table('webincome')
        ->where('webincome.IdBillDetail', 'like', '%' . $var_search . '%')
        ->paginate(10);
        return view('Admin.WebIncome', compact('webincomes'));
    }
}
