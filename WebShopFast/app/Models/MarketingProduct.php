<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class MarketingProduct extends Model
{
    use HasFactory; 
    public $IdMarketing;
    private $nameMakerting;
    private $DataMarketingProduct;
    private $IsSucces;
    private $products = array();

    public function addProduct($products) {
        $this->products[] = $products;
    }
 
    public function getNameMakerting()
    {
        return $this->nameMakerting;
    }

    public function setNameMakerting($nameMakerting)
    {
        $this->nameMakerting = $nameMakerting;

        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get the value of DataMarketingProduct
     */ 
    public function getDataMarketingProduct()
    {
        return $this->DataMarketingProduct;
    }

    /**
     * Set the value of DataMarketingProduct
     *
     * @return  self
     */ 
    public function setDataMarketingProduct($DataMarketingProduct)
    {
        $this->DataMarketingProduct = $DataMarketingProduct;

        return $this;
    }



    /**
     * Get the value of IsSucces
     */ 
    public function getIsSucces()
    {
        return $this->IsSucces;
    }

    /**
     * Set the value of IsSucces
     *
     * @return  self
     */ 
    public function setIsSucces($IsSucces)
    {
        $this->IsSucces = $IsSucces;

        return $this;
    }

    public function getDataForMarketingProduct($search = null, $marketingId = null)
    {        
        $DataMarketingProduct = DB::table('product')
                                ->join('marketingproduct', 'product.Id', '=', 'marketingproduct.ProductId')
                                ->join('marketing', 'marketing.Id', '=', 'marketingproduct.MarketingId')
                                ->select('marketingproduct.Id', 'product.Name AS ProductName', 'marketing.Name AS MarketingName', DB::raw('DATE_ADD(marketingproduct.Create_At, INTERVAL 30 DAY) AS ExpiryDate'))
                                ->where('product.user_id', Session::get('my_user_id'))
                                ->where('marketingproduct.Status', '=', 1);

        if ($search) {
            $DataMarketingProduct->where('product.Name', 'like', '%'.$search.'%');
        }
        if ($marketingId) {
            $DataMarketingProduct->where('marketing.Id', '=', $marketingId);    
        }
        
        // $this->DataMarketingProduct = $DataMarketingProduct;
        $result = $DataMarketingProduct->paginate(10);

        // return $this;
        return $result;
    }

    public function AddProductWithMarketing(Request $request)
    {        
        $productId =  $request->Input('productId');
        $marketingId =  $request->Input('marketingId');

        $userId = Session::get('my_user_id');
        $member = DB::table('member')->where('Id', $userId)->first();
        $accountBalance = $member->AccountBalance;

        $marketing = DB::table('marketing')->where('Id', $marketingId)->first();
        $marketingPrice = $marketing->Price;

        $IsSucces = false;
        if ($accountBalance >= $marketingPrice) 
        {
            $newBalance = $accountBalance - $marketingPrice;
            DB::table('member')->where('Id', $userId)->update(['AccountBalance' => $newBalance]);

            DB::table('marketingproduct')->insert([
                'productId' => $productId,
                'marketingId' => $marketingId,
                'Create_At' =>  Carbon::now()
            ]);
            $IsSucces = true;
        }
        $this->IsSucces = $IsSucces;
        return $this;
    }

    public function DeleteProductWithMarketing($id){
        DB::update('update marketingproduct set Status = 0 where Id = :ProductId', 
        [
            'ProductId' => $id,
        ]);
    }
}
