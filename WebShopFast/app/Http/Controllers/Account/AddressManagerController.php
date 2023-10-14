<?php

namespace App\Http\Controllers\Account;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressManagerController extends Controller
{
    public function index(){
        $address = new Address();
        $address = $address->getAddressData();
        return view('Account.addressManager')->with(['addresses' => $address->getAddresses(),'oaddresses'=>$address->getOaddresses()]);
     }

     public function editAddress(Request $request) {

        $address = new Address();
        $address = $address->editAddress($request);        
        return redirect('/AddressManager');
    }

     public function addAddress(Request $request){
        $address = new Address();
        $address = $address->addAddress($request); 
        return redirect('/AddressManager');
    }

    public function deleteAddress($id){
        $address = new Address();
        $address = $address->deleteAddress($id); 
        return redirect(('/AddressManager'));
    }

    public function makedefaultAddress($id){
        $address = new Address();
        $address = $address->makedefaultAddress($id); 
        return redirect(('/AddressManager'));
    }

}
