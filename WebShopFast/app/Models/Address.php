<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;
    private $ID;
    private $MemberId;
    private $Name;
    private $Status;
    private $addresses;
    private $oaddresses;

        /**
     * Get the value of ID
     */ 
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     *
     * @return  self
     */ 
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Get the value of MemberId
     */ 
    public function getMemberId()
    {
        return $this->MemberId;
    }

    /**
     * Set the value of MemberId
     *
     * @return  self
     */ 
    public function setMemberId($MemberId)
    {
        $this->MemberId = $MemberId;

        return $this;
    }

    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get the value of Status
     */ 
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Set the value of Status
     *
     * @return  self
     */ 
    public function setStatus($Status)
    {
        $this->Status = $Status;

        return $this;
    }
    
    /**
     * Get the value of addresses
     */ 
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set the value of addresses
     *
     * @return  self
     */ 
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;

        return $this;
    }

        /**
     * Get the value of oaddresses
     */ 
    public function getOaddresses()
    {
        return $this->oaddresses;
    }

    /**
     * Set the value of oaddresses
     *
     * @return  self
     */ 
    public function setOaddresses($oaddresses)
    {
        $this->oaddresses = $oaddresses;

        return $this;
    }

    public function getAddressData(){
        $user_id = Session::get('my_user_id');
        $addresses = DB::select("CALL getDefaultAddressById(:id)",[
            "id" => $user_id
        ]);

        $oaddresses = DB::select("CALL getOtherAddressById(:id)",[
            "id" => $user_id
        ]);
        
        $this->addresses = $addresses;
        $this->oaddresses = $oaddresses; 

        return $this;
     }

     public function editAddress(Request $request) {

        $id = $request->input('id');
        $address = $request->input('address');

        DB::update('update address set Name = :Name
         where ID = :ID',
        [
            'Name' => $address,                           
            'ID' =>  $id
        ]);
    }

    public function addAddress(Request $request){
        $user_id = Session::get('my_user_id');
        $Address = $request->input('address');
        DB::table('address')->insertGetId([
            'MemberId' => $user_id,
            'Name' =>  $Address,
            'Status' => 0,
        ]);
    }

    public function deleteAddress($id){
        DB::update('update address set Status = 2 where Id= :AddressId',
        [
            'AddressId' => $id,
        ]);
    }

    public function makedefaultAddress($id){

        $user_id = Session::get('my_user_id');

        DB::update('update address set Status = 0 where MemberId = :AId',
        [
            'AId' => $user_id
        ]);

        DB::update('update address set Status = 1 where Id= :AddressId',
        [
            'AddressId' => $id,
        ]);
        return redirect(('/AddressManager'));
    }
}
