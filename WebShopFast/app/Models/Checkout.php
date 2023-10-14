<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Checkout extends Model
{
    use HasFactory;
    private $carts;
    private $totalPrices;
    private $totalPrice;
    private $totalProduct;
    private $UserName;
    private $Phone;
    private $newAddress;
    private $PaymentMethodName;
    private $AddressName;
    private $userId;
    private $addressId;
    private $cartDetails;

    // Getter và Setter cho thuộc tính $carts
    public function setCarts($carts) {
        $this->carts = $carts;
    }

    public function getCarts() {
        return $this->carts;
    }

    // Getter và Setter cho thuộc tính $totalPrices
    public function setTotalPrices($totalPrices) {
        $this->totalPrices = $totalPrices;
    }

    public function getTotalPrices() {
        return $this->totalPrices;
    }

    public function setTotalPrice($totalPrice) {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    // Getter và Setter cho thuộc tính $totalProduct
    public function setTotalProduct($totalProduct) {
        $this->totalProduct = $totalProduct;
    }

    public function getTotalProduct() {
        return $this->totalProduct;
    }

    // Getter và Setter cho thuộc tính $UserName
    public function setUserName($UserName) {
        $this->UserName = $UserName;
    }

    public function getUserName() {
        return $this->UserName;
    }

    // Getter và Setter cho thuộc tính $Phone
    public function setPhone($Phone) {
        $this->Phone = $Phone;
    }

    public function getPhone() {
        return $this->Phone;
    }

    // Getter và Setter cho thuộc tính $newAddress
    public function setNewAddress($newAddress) {
        $this->newAddress = $newAddress;
    }

    public function getNewAddress() {
        return $this->newAddress;
    }

    // Getter và Setter cho thuộc tính $PaymentMethodName
    public function setPaymentMethodName($PaymentMethodName) {
        $this->PaymentMethodName = $PaymentMethodName;
    }

    public function getPaymentMethodName() {
        return $this->PaymentMethodName;
    }

    // Getter và Setter cho thuộc tính $AddressName
    public function setAddressName($AddressName) {
        $this->AddressName = $AddressName;
    }

    public function getAddressName() {
        return $this->AddressName;
    }

    // Getter và Setter cho thuộc tính $userId
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }

    // Getter và Setter cho thuộc tính $addressId
    public function setAddressId($addressId) {
        $this->addressId = $addressId;
    }

    public function getAddressId() {
        return $this->addressId;
    }
    
    /**
     * Get the value of cartDetails
     */ 
    public function getCartDetails()
    {
        return $this->cartDetails;
    }

    /**
     * Set the value of cartDetails
     *
     * @return  self
     */ 
    public function setCartDetails($cartDetails)
    {
        $this->cartDetails = $cartDetails;

        return $this;
    }

    public function getDataForCheckout() 
    {
        $user_id = Session::get('my_user_id');
        $carts = DB::select('CALL GetCartDetail(:id)', 
        [
             "id" => $user_id
        ]);

        $totalPrices = 0;
        foreach($carts as $item){
            $totalPrices += $item->Quantity * $item->Price;
        }

        $totalProduct = count($carts);


        $this->carts = $carts;  
        $this->totalPrices = $totalPrices;  
        $this->totalProduct = $totalProduct;  

        return $this;
    }

    public function AddNewAddress(Request $request) 
    {
        $UserId =  $request->Input('userId');
        $AddressName =  $request->Input('newAddress');
        $user = DB::select('select * from member where id = :user_id', 
        [
             "user_id" => $UserId
        ]);
        
        DB::insert('insert into address(MemberId, Name, Status) values (:memberId, :name, 0)', 
        [
            "memberId" => $UserId, 
            "name" => $AddressName
        ]);

        $this->UserName = $user[0]->Name;  
        $this->Phone = $user[0]->Phone;  
        $this->newAddress = $AddressName;  

        return $this;
    }

    public function UpdatePaymentMethod(Request $request) 
    {
        $cartId =  $request->Input('cartId');
        $paymentMethodID =  $request->Input('paymentMethodID');

        DB::update('update cart set PaymentMethodId = :PaymentMethodId where Id = :cart_id',
        [
            'PaymentMethodId' => $paymentMethodID,           
            'cart_id' =>  $cartId
        ]);

        $paymentMethod = DB::select('select * from paymentMethod where id = :paymentMethodID', 
        [
             "paymentMethodID" => $paymentMethodID
        ]);

        $this->PaymentMethodName = $paymentMethod[0]->Name;  
        return $this;
    }

    public function ChangeAddressCart(Request $request) 
    {
        $userId =  $request->Input('userId');
        $AddressID =  $request->Input('AddressID');

        DB::update('update cart set AddressId = :AddressId where status = 0 and member_id = :user_id',
        [
            'AddressId' => $AddressID,           
            'user_id' =>  $userId
        ]);

        $address = DB::select('select * from address where id = :AddressID', 
        [
             "AddressID" => $AddressID
        ]);

        $this->AddressName = $address[0]->Name;  
        return $this;
    }

    public function UpdateAddress(Request $request) 
    {
        $addressId =  $request->Input('AddressId');
        $userId =  $request->Input('userId');
        $newAddress =  $request->Input('newAddress');

        DB::update('update address set MemberId = :UserId, Name = :Name where Id = :AddressId',
        [
            'UserId' => $userId,           
            'Name' =>  $newAddress,
            'AddressId' =>  $addressId,
        ]);

        $this->userId = $userId;  
        $this->addressId = $addressId;  
        $this->newAddress = $newAddress;  
        return $this;
    }
}
