<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ShopCarrier extends Model
{
    use HasFactory;
    private $carriers;
    private $options;

    /**
     * Get the value of options
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @return  self
     */ 
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the value of carriers
     */ 
    public function getCarriers()
    {
        return $this->carriers;
    }

    /**
     * Set the value of carriers
     *
     * @return  self
     */ 
    public function setCarriers($carriers)
    {
        $this->carriers = $carriers;

        return $this;
    }

    public function getDataForShopCarrier($search = null){

        $user_id = Session::get('my_user_id');
        // $carriers = DB::select('call getOrders(:id)',
        // [
        //     "id" => $user_id,
        // ]);

        // $options = DB::select('select * from carrier');

        $carriers = DB::table('billdetail as bd')
                    ->join('bill as b', 'bd.IdBill', '=', 'b.Id')
                    ->join('product as p', 'bd.IdProduct', '=', 'p.Id')
                    ->select('bd.Id as Id', 'bd.ProductName as ProductName', 'bd.Price as Price', 'bd.Quantity as Quantity', 'b.Address as Address', 'b.create_at as Time')
                    ->where('p.user_id', $user_id)
                    ->where('bd.Status', '=', 2)
                    ->where('bd.IdCarrier', Null);

        $options = DB::table('carrier')
                    ->get();

        if($search){
            $carriers->where('bd.ProductName', 'like', '%'.$search.'%');
        }

        $this->setCarriers($carriers);
        $this->setOptions($options);
    
        return $this;
    }

    public function ChangeCarrier(Request $request, $id)
    {
        $idcarrier = $request->input('option');
        // Update the database with the selected ID
        DB::table('billdetail')->where('Id', $id)->update(['IdCarrier' => $idcarrier]);
    }
}
