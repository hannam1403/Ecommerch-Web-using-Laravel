<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Order extends Model
{
    use HasFactory;
    private $orders;
    private $confirmOrders;
    private $preDeliveryOrders;
    private $deliveryOrdersSuccess;
    private $abortOrders;
    private $check;
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

    public function getCheck()
    {
        return $this->check;
    }

    /**
     * Set the value of check
     *
     * @return  self
     */ 
    public function setCheck($check)
    {
        $this->check = $check;

        return $this;
    }

    public function getDataForNewOrder($search = null){

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
                ->where('product.user_id', $user_id)
                ->distinct();

        if($search){
            $orders->where('billdetail.ProductName', 'like', '%'.$search.'%');
        }

        $result = $orders->paginate(10);

        return $result;
    }

    public function getDataForConfirmOrder($search = null){

        $user_id = Session::get('my_user_id');

        $confirmOrders = DB::table('billdetail')
                ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 'member.Name as CusName', 'bill.Address as Address', 'bill.create_at as Time', 'billdetail.Price as Price', 'billdetail.Quantity as Quantity', 'paymentmethod.Name as PaymentMethod')
                ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
                ->join('member', 'bill.IdMember', '=', 'member.Id')
                ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
                ->join('paymentmethod','bill.PaymentMethod', '=', 'paymentmethod.ID')
                ->where('billdetail.Status', 2)
                ->where('product.user_id', $user_id)
                ->distinct();

        if($search){
            $confirmOrders->where('billdetail.ProductName', 'like', '%'.$search.'%');
        }

       $result = $confirmOrders->paginate(10);
        return $result;
    }

    public function getDataForPreDeliveryOrder($search = null){

        $user_id = Session::get('my_user_id');

        $preDeliveryOrders = DB::table('billdetail')
                ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 
                    'member.Name as CusName', 'bill.Address as Address', 'bill.create_at as Time',
                    'billdetail.Price as Price', 'billdetail.Quantity as Quantity',
                    'paymentmethod.Name as PaymentMethod')
                ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
                ->join('member', 'bill.IdMember', '=', 'member.Id')
                ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
                ->join('paymentmethod','bill.PaymentMethod', '=', 'paymentmethod.ID')
                ->where('billdetail.Status', 3)
                ->where('product.user_id', $user_id)
                ->distinct();

        if($search){
            $preDeliveryOrders->where('billdetail.ProductName', 'like', '%'.$search.'%');
        }

       $result = $preDeliveryOrders->paginate(10);
        return $result;
    }

    public function getDataForDeliverySuccessOrder($search = null){

        $user_id = Session::get('my_user_id');

        $deliveryOrdersSuccess = DB::table('billdetail')
                ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 'member.Name as CusName', 'bill.Address as Address', 'bill.create_at as Time', 'billdetail.Price as Price', 'billdetail.Quantity as Quantity')
                ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
                ->join('member', 'bill.IdMember', '=', 'member.Id')
                ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
                ->where('billdetail.Status', 4)
                ->where('product.user_id', $user_id)
                ->distinct();

        if($search){
            $deliveryOrdersSuccess->where('billdetail.ProductName', 'like', '%'.$search.'%');

        }

        $result = $deliveryOrdersSuccess->paginate(10);
        return $result;
    }

    public function getDataForAbortOrder($search = null){

        $user_id = Session::get('my_user_id');

        $abortOrders = DB::table('billdetail')
                ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 'member.Name as CusName', 'bill.Address as Address', 'bill.create_at as Time', 'billdetail.Price as Price', 'billdetail.Quantity as Quantity')
                ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
                ->join('member', 'bill.IdMember', '=', 'member.Id')
                ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
                ->where('billdetail.Status', 5)
                ->where('product.user_id', $user_id)
                ->distinct();

        if($search){
            $abortOrders->where('billdetail.ProductName', 'like', '%'.$search.'%');
        }

        $result = $abortOrders->paginate(10);
        return $result;
    }

    public function getDataForDeliveryNotSuccessOrder($search = null){

        $user_id = Session::get('my_user_id');

        $deliveryOrdersNotSuccess = DB::table('billdetail')
                ->select('billdetail.Id as ID', 'billdetail.ProductName as ProductName', 
                            'member.Name as CusName', 'bill.Address as Address', 'bill.create_at as Time', 
                            'billdetail.Price as Price', 'billdetail.Quantity as Quantity', 'reasonabort.Reason as Reason')
                ->join('bill', 'billdetail.IdBill', '=', 'bill.Id')
                ->join('member', 'bill.IdMember', '=', 'member.Id')
                ->join('product', 'billdetail.IdProduct', '=', 'product.Id')
                ->join('reasonabort', 'billdetail.IdReasonAbort', '=', 'reasonabort.Id')
                ->where('billdetail.Status', 6)
                ->where('product.user_id', $user_id)
                ->distinct();

        if($search){
            $deliveryOrdersNotSuccess->where('billdetail.ProductName', 'like', '%'.$search.'%');

        }

        $result = $deliveryOrdersNotSuccess->paginate(10);
        return $result;
    }

    public function ChangeOrderStatusToApprove($id){
        DB::update('update billdetail set Status = 2 where Id = :Id', [
            "Id" => $id
        ]);
    }

    public function ChangeOrderStatusToPreDelivery($id){
        $check = DB::table('billdetail')->where('id', $id)->first();
        $this->setCheck($check->IdCarrier);

        return $this;
    }

    public function ChangeOrderStatusToDeliverySuccess($id){
        $user_id = Session::get('my_user_id');

        DB::update('update billdetail set Status = 4, TimeSold = :TimeSold where Id = :Id', [
            "Id" => $id,
            "TimeSold" => now()
        ]);

        $moneys = DB::table('billdetail')
        ->select('billdetail.Price as Price','billdetail.Quantity as Quantity', 'bill.PaymentMethod as PaymentMethod')
        ->join('bill', 'bill.Id', '=', 'billdetail.IdBill')
        ->where('billdetail.Id', $id)
        ->where('billdetail.Status', '=', 4)
        ->get();    

        $revenueshop = 0;
        $revenueweb = 0;

        foreach($moneys as $money){

            $revenueshop = $money->Price * $money->Quantity * 95 / 100;
            $revenueweb = $money->Price * $money->Quantity * 5 / 100;

            DB::table('member')
            ->where('Id', '=', $user_id)
            ->increment('AccountBalance', $revenueshop);

            DB::table('webincome')
            ->insert([
                'IdBillDetail' => $id,
                'Income' => $revenueweb,
            ]);                             
        }
    }

    public function ChangeOrderStatusToAbort($id){
        
        DB::transaction(function () use ($id){
            $user_id = Session::get('my_user_id');

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
    }

    public function ChangeOrderStatusToDeliveryNotSuccess(Request $request){
        $user_id = Session::get('my_user_id');

        $id= $request->input('Id');
        $reasonabort = $request->input('reason');

        $fine = 15000;

        $members = DB::table('bill')
        ->select('bill.IdMember as IdMember')
        ->join('billdetail', 'bill.Id', '=', 'billdetail.IdBill')
        ->where('billdetail.Id', $id)
        ->get();

        $quantities = DB::table('billdetail as bd')
            ->select('p.Id as Id', DB::raw('SUM(bd.Quantity) as Quantity'))
            ->join('product as p', 'p.Id', '=', 'bd.IdProduct')
            ->where('bd.Id', $id)
            ->groupBy('p.Id')
            ->get(); 

        DB::table('billdetail')
            ->where('Id', $id)
            ->update(
                [
                    'Status' => 6,
                    'IdReasonAbort' => $reasonabort
                ]); 

        $moneys = DB::table('billdetail')
        ->select('billdetail.Price as Price', 'billdetail.Quantity as Quantity', 'bill.PaymentMethod as PaymentMethod')
        ->join('bill', 'bill.Id', '=', 'billdetail.IdBill')
        ->where('billdetail.Id', $id)
        ->where('billdetail.Status', '=', 6)
        ->get();   

        foreach($members as $member){
            if($reasonabort == 1){
                DB::table('member')
                ->where('Id', $member->IdMember)
                ->decrement('AccountBalance', $fine);

            foreach ($quantities as $quantity) {
                    DB::table('product')
                    ->where('Id', $quantity->Id)
                    ->increment('QuantityInStock', $quantity->Quantity);
                }
            }
            else{
                foreach($moneys as $money){
                    DB::table('member')
                    ->where('Id', $member->IdMember)
                    ->increment('AccountBalance', $money->Price * $money->Quantity);
                } 
            }
        }
    }

}
