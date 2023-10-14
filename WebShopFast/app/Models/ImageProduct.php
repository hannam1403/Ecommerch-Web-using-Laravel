<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageProduct extends Model
{   
    use HasFactory;
    private $Id; 
    private $ImgProductPath;  
    private $ProductId;  

    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    public function getImgProductPath()
    {
        return $this->ImgProductPath;
    }


    public function setImgProductPath($ImgProductPath)
    {
        $this->ImgProductPath = $ImgProductPath;

        return $this;
    }


    public function getProductId()
    {
        return $this->ProductId;
    }

    public function setProductId($ProductId)
    {
        $this->ProductId = $ProductId;

        return $this;
    }

    public function getDataForImageManager() 
    {
        
        $user_id = Session::get('my_user_id');
        // $products =  DB::select("CALL getImageProductByProductId(:id)", 
        // [
        //     "id" => $user_id
        // ]);
        $products = DB::table('imageproduct')
                        ->join('product', 'product.Id', '=', 'imageproduct.ProductId')
                        ->orderBy('imageproduct.ProductId')
                        ->select('imageproduct.id as ID', 'imageproduct.ImgProductPath as Pic', 'imageproduct.ProductId as ProductID', 'product.Name AS ProductName')
                        ->where('product.user_id', $user_id)
                        ->where('imageproduct.Status', 1);
        return $products;
    }

    public function search(Request $request) 
    {
        $SearchValue = $request->query('SearchValue');
        
        $user_id = Session::get('my_user_id');
        $products = null;
        if($SearchValue == null) {
            $products = DB::table('imageproduct')
            ->join('product', 'product.Id', '=', 'imageproduct.ProductId')
            ->orderBy('imageproduct.ProductId')
            ->select('imageproduct.id as ID', 'imageproduct.ImgProductPath as Pic', 'imageproduct.ProductId as ProductID', 'product.Name AS ProductName')
            ->where('product.user_id', $user_id)->paginate(2);

            return $products;
        }
        else {
            $products = DB::table('imageproduct')
                        ->join('product', 'product.Id', '=', 'imageproduct.ProductId')
                        ->where('product.user_id', $user_id)
                        ->where('product.name', 'LIKE', '%' . $SearchValue . '%')
                        ->select('imageproduct.id as ID', 'imageproduct.ImgProductPath as Pic', 'imageproduct.ProductId as ProductID', 'product.Name AS ProductName')
                        ->orderBy('imageproduct.ProductId')->paginate(2);

            return $products;
        }
    }


    public function addImageProduct(Request $request) {
        //$user_id = Session::get('my_user_id');
        $productID = $request->input('ProductID');

        $productImageProduct = 'ImageProduct'.'-'.time().'-'.Session::get('my_user_id').'.'.$request->ImageProduct->extension();
        $request->ImageProduct->move(public_path('images/Product/'), $productImageProduct);

        DB::table('imageproduct')->insert([
            'ImgProductPath' => $productImageProduct,
            'ProductId' => $productID 
        ]);
    }
    public function removeImageProduct($id){
        DB::delete("DELETE FROM ImageProduct where ID = :ProductId", 
        [
                'ProductId' => $id,
        ]);
    }
}
