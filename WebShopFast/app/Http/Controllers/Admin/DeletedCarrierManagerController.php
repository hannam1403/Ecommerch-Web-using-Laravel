<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrier;

class DeletedCarrierManagerController extends Controller
{
    public function index(){
        $deletedcarriers = new Carrier();
        $deletedcarriers = $deletedcarriers->getDeletedCarrierData();
        return view('Admin.DeletedCarrierManager')->with('deletedcarriers', $deletedcarriers);
    }

    public function search(Request $request){
        $deletedcarriers = new Carrier();
        $deletedcarriers = $deletedcarriers->getDeletedCarrierSearchData($request);
        return view('Admin.DeletedCarrierManager')->with('deletedcarriers', $deletedcarriers);
    }

    public function active($id){
        $deletedcarriers = new Carrier();
        $deletedcarriers->activeCarrier($id);
        return redirect()->back();
    }


}
