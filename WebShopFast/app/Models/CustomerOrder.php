<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;
    private $orders;
    private $confirmOrders;
    private $preDeliveryOrders;
    private $deliveryOrdersSuccess;
    private $abortOrders;
    
        /**
     * Get the value of abortOrders
     */ 
    public function getAbortOrders()
    {
        return $this->abortOrders;
    }

    /**
     * Set the value of abortOrders
     *
     * @return  self
     */ 
    public function setAbortOrders($abortOrders)
    {
        $this->abortOrders = $abortOrders;

        return $this;
    }

    /**
     * Get the value of deliveryOrdersSuccess
     */ 
    public function getDeliveryOrdersSuccess()
    {
        return $this->deliveryOrdersSuccess;
    }

    /**
     * Set the value of deliveryOrdersSuccess
     *
     * @return  self
     */ 
    public function setDeliveryOrdersSuccess($deliveryOrdersSuccess)
    {
        $this->deliveryOrdersSuccess = $deliveryOrdersSuccess;

        return $this;
    }

    /**
     * Get the value of preDeliveryOrders
     */ 
    public function getPreDeliveryOrders()
    {
        return $this->preDeliveryOrders;
    }

    /**
     * Set the value of preDeliveryOrders
     *
     * @return  self
     */ 
    public function setPreDeliveryOrders($preDeliveryOrders)
    {
        $this->preDeliveryOrders = $preDeliveryOrders;

        return $this;
    }

    /**
     * Get the value of confirmOrders
     */ 
    public function getConfirmOrders()
    {
        return $this->confirmOrders;
    }

    /**
     * Set the value of confirmOrders
     *
     * @return  self
     */ 
    public function setConfirmOrders($confirmOrders)
    {
        $this->confirmOrders = $confirmOrders;

        return $this;
    }

    /**
     * Get the value of orders
     */ 
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Set the value of orders
     *
     * @return  self
     */ 
    public function setOrders($orders)
    {
        $this->orders = $orders;

        return $this;
    }


    public function getDataCustomerOrder(){
        $user_id = Session::get('my_user_id');
        $orders = DB::table('billdetail')
        ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 'member.Name as CusName',
                 'bill.Address as Address', 'bill.create_at as Time', 'billdetail.Price as Price', 
                 'billdetail.Quantity as Quantity','paymentmethod.Name as PaymentMethod')
        ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
        ->join('member', 'bill.IdMember', '=', 'member.Id')
        ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
        ->join('paymentmethod','bill.PaymentMethod', '=', 'paymentmethod.ID')
        ->where('billdetail.Status', 1)
        ->where('bill.IdMember', $user_id)
        ->distinct();

        $confirmOrders = DB::table('billdetail')
        ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 'member.Name as CusName',
                 'bill.Address as Address', 'bill.create_at as Time', 'billdetail.Price as Price', 
                 'billdetail.Quantity as Quantity','paymentmethod.Name as PaymentMethod')
        ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
        ->join('member', 'bill.IdMember', '=', 'member.Id')
        ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
        ->join('paymentmethod','bill.PaymentMethod', '=', 'paymentmethod.ID')
        ->where('billdetail.Status', 2)
        ->where('bill.IdMember', $user_id)
        ->distinct();

        $preDeliveryOrders =  DB::select("call getCustomerPreDeliveryOrder(:id)", 
        [
            "id" => $user_id
        ]);
        $deliveryOrdersSuccess =  DB::select("call getCustomerDeliveryOrderSuccess(:id)", 
        [
            "id" => $user_id
        ]);
        $abortOrders =  DB::select("call getCustomerAbortOrder(:id)", 
        [
            "id" => $user_id
        ]);

        $notSuccessOrders = DB::table('billdetail')
        ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 'member.Name as CusName',
                 'bill.Address as Address', 'bill.create_at as Time', 'billdetail.Price as Price', 
                 'billdetail.Quantity as Quantity','paymentmethod.Name as PaymentMethod')
        ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
        ->join('member', 'bill.IdMember', '=', 'member.Id')
        ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
        ->join('paymentmethod','bill.PaymentMethod', '=', 'paymentmethod.ID')
        ->where('billdetail.Status', 6)
        ->where('bill.IdMember', $user_id)
        ->distinct();

        
        $this->orders = $orders;
        $this->confirmOrders = $confirmOrders; 
        $this->preDeliveryOrders = $preDeliveryOrders;
        $this->deliveryOrdersSuccess = $deliveryOrdersSuccess;  
        $this->abortOrders = $abortOrders;  
        $this->notSuccessOrders= $notSuccessOrders;

        return $this;
    }    

    

    public function getDataToShow($idUser){
        $orders =  DB::select("call getCustomerNewOrder(:id)", 
        [
            "id" => $idUser
        ]);
        $confirmOrders =  DB::select("call getCustomerConfirmOrder(:id)", 
        [
            "id" => $idUser
        ]);
        $preDeliveryOrders =  DB::select("call getCustomerPreDeliveryOrder(:id)", 
        [
            "id" => $idUser
        ]);
        $deliveryOrdersSuccess =  DB::select("call getCustomerDeliveryOrderSuccess(:id)", 
        [
            "id" => $idUser
        ]);
        $abortOrders =  DB::select("call getCustomerAbortOrder(:id)", 
        [
            "id" => $idUser
        ]);

        $this->orders = $orders;
        $this->confirmOrders = $confirmOrders; 
        $this->preDeliveryOrders = $preDeliveryOrders;
        $this->deliveryOrdersSuccess = $deliveryOrdersSuccess;  
        $this->abortOrders = $abortOrders;  

        return $this;
    }

    public function ChangeOrderStatusToAbort($id){
        
        DB::transaction(function () use ($id){
            // Update the order status to 5
            DB::table('billdetail')
            ->where('Id', $id)
            ->update(['Status' => 5]);

            $paymentmethods = DB::select('call getPaymentMethodOfBill(:id)',
            [
                "id" => $id
            ]);

            foreach($paymentmethods as $paymentmethod){
                DB::table('member')
                    ->where('Id', $paymentmethod->Id)
                    ->increment('AccountBalance', $paymentmethod->Price);
            }
            
            // Update quantity for products
            $quantities = DB::table('billdetail as bd')
            ->select('p.Id as Id', DB::raw('SUM(bd.Quantity) as Quantity'))
            ->join('product as p', 'p.Id', '=', 'bd.IdProduct')
            ->where('bd.Id', $id)
            ->groupBy('p.Id')
            ->get();

            foreach ($quantities as $quantity) {
                DB::table('product')
                    ->where('Id', $quantity->Id)
                    ->increment('QuantityInStock', $quantity->Quantity);
            }
        });
        return redirect()->back()->with('success', 'Order aborted successfully.'); 
    }
}
