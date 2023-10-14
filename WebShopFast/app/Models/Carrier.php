<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Carrier extends Model
{
    use HasFactory;
    private $id;
    private $name;
    private $address;
    private $phone;
    private $carrierstatus;
    private $email;
    //private $price;


    public function getCarrierData(){
        $carriers = DB::table('carrier')
                        ->select('carrier.id', 'carrier.name', 'carrier.address', 'carrier.phone', 'carrier.email')
                        ->where('carrier.carrierstatus', '=', '1');
        return $carriers;
    }
    public function getCarrierSearchData(Request $request){
        $var_search = $request->query('var_search');
        $carriers = DB::table('carrier')
                        ->select('carrier.id', 'carrier.name', 'carrier.address', 'carrier.phone', 'carrier.email')
                        ->where('carrier.carrierstatus', '=', '1')
                        ->where('carrier.name', 'like', '%' . $var_search . '%');
        return $carriers;
    }

    public function addCarrier(Request $request){
        $carrierName = $request->input('name');
        $carrierAddress = $request->input('address');
        $carrierPhoneNumber= $request->input('phonenumber');
        $carrierEmail= $request->input('email');
        //$carrierPrice= $request->input('price');

        DB::table('carrier')->insertGetId([
            'name' => $carrierName ,
            'address' =>  $carrierAddress,
            'phone' =>  $carrierPhoneNumber,
            'email' => $carrierEmail,
            //'Price' => $carrierPrice,
            'carrierstatus' => 1,
        ]);

        return redirect('/CarrierManager');
    }

    public function editCarrier(Request $request) {
        $id = $request->input('id');
        $name = $request->input('name');
        $address = $request->input('address');
        $phonenumber = $request->input('phonenumber');
        $email = $request->input('email');
        //$price = $request->input('price');

        DB::update('update carrier set name = :name, address = :address, 
        phone = :phone, email = :email where id = :id',
        [
            'name' => $name, 
            'address' => $address,
            'phone' => $phonenumber,
            'email' => $email,                              
            //'price' => $price,                              
            'id' =>  $id
        ]);
    }

    public function deleteCarrier($id){
        DB::update('update carrier set carrierstatus = 0 where Id= :CarrierId',
        [
            'CarrierId' => $id,
        ]);
    }

    public function getDeletedCarrierData(){
        $deletedcarriers = DB::table('carrier')
                    ->where('carrierstatus', '=', 0)
                    ->paginate(5);
        return $deletedcarriers;
    }

    public function getDeletedCarrierSearchData(Request $request){
        $var_search = $request->query('var_search');
        $deletedcarriers = DB::table('carrier')
                    ->where('carrier.name', 'like', '%' . $var_search . '%')
                    ->where('carrierstatus', '=', 0)
                    ->paginate(5);
        return $deletedcarriers;
    }

    public function activeCarrier($id){
        DB::update('update carrier set carrierstatus = 1 where Id= :CarrierId',
        [
            'CarrierId' => $id,
        ]);
    }
}
