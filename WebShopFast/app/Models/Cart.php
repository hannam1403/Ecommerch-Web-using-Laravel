<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory; 
    private $CartID;
    private $ProductID;
    private $Name;  
    private $Quantity;
    private $Price;
    private $carts;  
    private $totalPrices;  
    private $totalProduct; 
    private $newQuantity;
    private $PriceProductAmount;
    private $isExist;

    public $totalPrice = 0;

    public function getCartID()
    {
        return $this->CartID;
    }

    public function setCartID($CartID)
    {
        $this->CartID = $CartID;
    }
    public function getProductID()
    {
        return $this->ProductID;
    }

    public function setProductID($ProductID)
    {
        $this->ProductID = $ProductID;
    }
    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function getQuantity()
    {
        return $this->Quantity;
    }

    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
    }
    public function getPrice()
    {
        return $this->Price;
    }


    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * Get the value of carts
     */ 
    public function getCarts()
    {
        return $this->carts;
    }

    /**
     * Set the value of carts
     *
     * @return  self
     */ 
    public function setCarts($carts)
    {
        $this->carts = $carts;

        return $this;
    }

    /**
     * Get the value of totalPrices
     */ 
    public function getTotalPrices()
    {
        return $this->totalPrices;
    }

    /**
     * Set the value of totalPrices
     *
     * @return  self
     */ 
    public function setTotalPrices($totalPrices)
    {
        $this->totalPrices = $totalPrices;

        return $this;
    }

    /**
     * Get the value of totalProduct
     */ 
    public function getTotalProduct()
    {
        return $this->totalProduct;
    }

    /**
     * Set the value of totalProduct
     *
     * @return  self
     */
     
    public function setTotalProduct($totalProduct)
    {
        $this->totalProduct = $totalProduct;

        return $this;
    }

        /**
     * Get the value of newQuantity
     */ 
    public function getNewQuantity()
    {
        return $this->newQuantity;
    }

    /**
     * Set the value of newQuantity
     *
     * @return  self
     */ 
    public function setNewQuantity($newQuantity)
    {
        $this->newQuantity = $newQuantity;

        return $this;
    }

        /**
     * Get the value of PriceProductAmount
     */ 
    public function getPriceProductAmount()
    {
        return $this->PriceProductAmount;
    }

    /**
     * Set the value of PriceProductAmount
     *
     * @return  self
     */ 
    public function setPriceProductAmount($PriceProductAmount)
    {
        $this->PriceProductAmount = $PriceProductAmount;

        return $this;
    }

        /**
     * Get the value of isExist
     */ 
    public function getIsExist()
    {
        return $this->isExist;
    }

    /**
     * Set the value of isExist
     *
     * @return  self
     */ 
    public function setIsExist($isExist)
    {
        $this->isExist = $isExist;

        return $this;
    }

    public function getDataForCart(){
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

    public function increaseQuantity($CartDetailID)
    {
        $Product =  DB::select('select * from CartDetail where Id = :id', 
        [
             "id" => $CartDetailID
        ]);
        $newQuantity = $Product[0]->Quantity + 1;
        $PriceProductAmount = $Product[0]->Price * $newQuantity;

        DB::update('update CartDetail set Quantity = :quantity where Id = :id', [
            "quantity" => $newQuantity,
            "id" => $CartDetailID
        ]);

        $user_id = Session::get('my_user_id');
        $carts = DB::select('CALL GetCartDetail(:id)', 
        [
             "id" => $user_id
        ]);

        $totalPrices = 0;
        foreach($carts as $item){
            $totalPrices += $item->Quantity * $item->Price;
        }
        $this->newQuantity = $newQuantity;
        $this->totalPrices = $totalPrices;
        $this->PriceProductAmount = $PriceProductAmount;
        return $this;
    }

    public function decreaseQuantity($CartDetailID)
    {
        $Product =  DB::select('select * from CartDetail where Id = :id', 
        [
             "id" => $CartDetailID
        ]);

        $newQuantity = $Product[0]->Quantity - 1;
        $PriceProductAmount = $Product[0]->Price * $newQuantity;

        DB::update('update CartDetail set Quantity = :quantity where Id = :id', [
            "quantity" => $newQuantity,
            "id" => $CartDetailID
        ]);

        $user_id = Session::get('my_user_id');
        $carts = DB::select('CALL GetCartDetail(:id)', 
        [
             "id" => $user_id
        ]);

        $totalPrices = 0;
        foreach($carts as $item){
            $totalPrices += $item->Quantity * $item->Price;
        }
        $this->newQuantity = $newQuantity;
        $this->totalPrices = $totalPrices;
        $this->PriceProductAmount = $PriceProductAmount;
        return $this;
    }

    public function removeProductFromCart($CartDetailID) {
        DB::delete("DELETE FROM CartDetail where Id = :CartDetailID", 
        [
                'CartDetailID' => $CartDetailID,
        ]);
    }

    public function addProductToCart($ProductId) {
        $user_id = session('my_user_id');
        $data = DB::select("SELECT COUNT(Id) as Count FROM `cart` WHERE STATUS = 0 and member_id = :user_id", 
        [
                'user_id' => $user_id
        ]);
        $isExist = false;
        if($data[0]->Count == 0) {
            $Address = DB::select("select * from Address where memberId = :user_id and status = 1", 
            [
                "user_id" => $user_id
            ]);

            $AddressId = $Address[0]->ID;

            $CartId = DB::table('cart')->insertGetId([
                'member_id' => $user_id,
                'create_at' => date("Y-m-d"),
                'Status' => 0,
                'AddressId' => $AddressId,
                'PaymentMethodId' => 1
            ]);

            $dataProduct = DB::select("SELECT * FROM `product` WHERE  Id = :productId", 
            [
                    'productId' => $ProductId
            ]);

            $priceProduct = $dataProduct[0]->Price;

            DB::insert("INSERT INTO CartDetail (CartId, ProductId, Quantity, Price) VALUES (:CartId, :ProductId, 1, :Price)", 
            [
                'CartId' => $CartId,
                'ProductId' => $ProductId,
                'Price' => $priceProduct,
            ]);
        }
        else {
            $dataCart = DB::select("SELECT * FROM `cart` WHERE STATUS = 0 and member_id = :user_id", 
            [
                    'user_id' => $user_id
            ]);
            $dataProduct = DB::select("SELECT * FROM `product` WHERE  Id = :productId", 
            [
                    'productId' => $ProductId
            ]);
            $CartId = $dataCart[0]->Id;
            $priceProduct = $dataProduct[0]->Price;

            $dataCart = DB::select("SELECT * FROM `cart` WHERE STATUS = 0 and member_id = :user_id", 
            [
                    'user_id' => $user_id
            ]);

            $dataCheckExist = DB::select("SELECT Count(ProductId) as Count FROM CartDetail WHERE ProductId = :productId and CartId = :CartId", 
            [
                'productId' => $ProductId,
                'CartId' => $dataCart[0]->Id
            ]);

            if($dataCheckExist[0]->Count == 0) 
            {
                DB::insert("INSERT INTO CartDetail (CartId, ProductId, Quantity, Price) VALUES (:CartId, :ProductId, 1, :Price)", 
                [
                    'CartId' => $CartId,
                    'ProductId' => $ProductId,
                    'Price' => $priceProduct,
                ]);
            }
            else {
                $isExist = true;
            }    
        }
        $this->isExist = $isExist;
        return $this;
    }

    public function removeCartProduct($id) {
        DB::delete("DELETE FROM cartdetail where ID = :ID", 
        [
                'ID' => $id,
        ]);
    }

}
