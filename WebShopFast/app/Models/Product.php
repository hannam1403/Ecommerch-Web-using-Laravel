<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Product extends Model
{   
    use HasFactory;
    private $Id; 
    private $Name;  
    private $Price;  
    private $Description; 
    private $CategoryId; 
    private $SubcategoryId; 
    private $user_id;
    private $ImageRepersent;
    private $OwnerProduct;
    private $QuantityInStock;
    private $ShopId;
    private $images = array();
    private $comments;

    public function getComments()
    {
        return $this->comments;
    }

    public function addComment($comment) {
        $this->comments = $comment;
    }

    public function getQuantityInStock()
    {
        return $this->QuantityInStock;
    }

    public function setQuantityInStock($QuantityInStock)
    {
        $this->QuantityInStock = $QuantityInStock;
    }

    public function getOwnerProduct()
    {
        return $this->NameShop;
    }

    public function setOwnerProduct($NameShop)
    {
        $this->NameShop = $NameShop;
    }

    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function getPrice()
    {
        return $this->Price;
    }


    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription($Description)
    {
        $this->Description = $Description;
    }


    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function addImage($image) {
        $this->images[] = $image;
    }


    public function getCategoryId()
    {
        return $this->CategoryId;
    }

    public function setCategoryId($CategoryId)
    {
        $this->CategoryId = $CategoryId;

        return $this;
    }

    public function getSubCategoryId()
    {
        return $this->SubCategoryId;
    }

    public function setSubCategoryId($SubCategoryId)
    {
        $this->SubCategoryId = $SubCategoryId;

        return $this;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getImageRepersent()
    {
        return $this->ImageRepersent;
    }

    public function setImageRepersent($ImageRepersent)
    {
        $this->ImageRepersent = $ImageRepersent;

        return $this;
    }

    public function getShopId()
    {
        return $this->ShopId;
    }

    public function setShopId($ShopId)
    {
        $this->ShopId = $ShopId;

        return $this;
    }
    public function getDataForProductManager() 
    {
        $user_id = Session::get('my_user_id');
        $products = DB::table('product')
                ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                 'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                ->where('product.user_id', '=', $user_id)
                ->where('product.deleted', '=', 0)
                ->paginate(5);
        return $products;
    }

    public function search(Request $request) 
    {
        $SearchValue = $request->query('SearchValue');
        $typeSearch =  $request->query('typeSearch');
        
        $user_id = Session::get('my_user_id');
        $products = null;
        if($SearchValue == null) {
            $products = DB::table('product')
                ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                 'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                ->where('product.user_id', '=', $user_id)
                ->where('product.deleted', '=', 0)
                ->paginate(5);

            return $products;
        }
        else {
            switch($typeSearch) 
            {
                case "0":
                    $products = DB::table('product')
                        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                        ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                        'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                        ->where('product.user_id', '=', $user_id)
                        ->where('product.deleted', '=', 0)
                        ->paginate(5);
                    break;
                case "1":
                    $products = DB::table('product')
                        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                        ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id') 
                        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                        'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                        ->where('product.user_id', '=', $user_id)
                        ->where('product.deleted', '=', 0)
                        ->where('product.name', 'LIKE', '%' . $SearchValue . '%')
                        ->paginate(5);
                    break;
                case "2":
                    $products = DB::table('product')
                        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                        ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                        'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                        ->where('product.user_id', '=', $user_id)
                        ->where('product.deleted', '=', 0)
                        ->where('categoryproduct.name', 'LIKE', '%' . $SearchValue . '%')
                        ->paginate(5);
                    break;               
            }
            return $products;
        }
    }

    public function sort(Request $request) 
    {
        $IsSortAsc =  $request->query('IsSortAsc');
        $TypeColumn =  $request->query('TypeColumn');
        $sort = $IsSortAsc == "1" ? 'asc' : 'desc';
        $user_id = Session::get('my_user_id');
        $products = null;

        switch($TypeColumn) 
        {
            case "1":
                $products = DB::table('product')
                        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                        ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id') 
                        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                        'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                        ->where('product.user_id', '=', $user_id)
                        ->where('product.deleted', '=', 0)
                        ->orderBy('product.Price', $sort)
                        ->paginate(5);
                break;
            case "2":
                $products = DB::table('product')
                        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                        ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id') 
                        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                        'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                        ->where('product.user_id', '=', $user_id)
                        ->where('product.deleted', '=', 0)
                        ->orderBy('product.QuantityInStock', $sort)
                        ->paginate(5);
                break;
            default:
                $products = DB::table('product')
                        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
                        ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id') 
                        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock', 'product.Description',
                        'categoryproduct.Name as CategoryName', 'subcategory.Name as subcategoryName')
                        ->where('product.user_id', '=', $user_id)
                        ->where('product.deleted', '=', 0)
                        ->paginate(5);        
        }
        return $products;
    }

    public function addProduct(Request $request) 
    {
         // Get the input data from the form
         $user_id = Session::get('my_user_id');
         $productName = $request->input('name');
         $productPrice = $request->input('price');
         $productCategory= $request->input('category');
         $productSubCategory= $request->input('subCategory');
         $productDescription= $request->input('description');
         $productQuantity= $request->input('quantity');
         //$productImageProduct= $request->input('ImageProduct');
 
         if($request->ImageProduct == null) {
             $productImageProduct = null;
         }
         else {
             $productImageProduct = 'imageProduct'.'-'.time().'-'.Session::get('my_user_id').'.'.$request->ImageProduct->extension();
             $request->ImageProduct->move(public_path('images/Product/'), $productImageProduct);
         }
 
         $id_product = DB::table('product')->insertGetId([
             'name' => $productName ,
             'price' =>  $productPrice,
             'description' =>  $productDescription,
             'categoryid' => $productCategory,
             'SubCategoryId' => $productSubCategory,
             'user_id' => $user_id,
             'QuantityInStock' => $productQuantity,
             'deleted' => 0,
         ]);
 
         DB::table('imageproduct')->insert([
             'ImgProductPath' => $productImageProduct,
             'ProductId' => $id_product 
         ]);
    }

    public function removeProduct($id) {

        DB::update('update product set deleted = 1 where Id = :ProductId', 
        [
            'ProductId' => $id,
        ]);
        DB::update('update imageproduct set Status = 0 where ProductId = :ProductId', 
        [
            'ProductId' => $id,
        ]);
    }

    public function EditProduct(Request $request) 
    {
        $Id = $request->input('Id');
        $name = $request->input('name');
        $price = $request->input('price');
        $category = $request->input('category');
        $SubCategory= $request->input('subCategory');
        $description = $request->input('description');
        $quantity = $request->input('quantity');

        DB::update('update product set Name = :Name, Price = :Price, 
            Description = :Description, CategoryId = :CategoryId, SubCategoryId = :SubCategoryId, 
            QuantityInStock = :QuantityInStock where Id = :Id',
        [
            'Name' => $name, 
            'Price' => $price,
            'Description' => $description,
            'CategoryId' => $category,  
            'SubCategoryId' => $SubCategory,             
            'QuantityInStock' => $quantity,               
            'Id' =>  $Id
        ]);
    }

    public function getProductListingData(){

        // $products =  DB::select("CALL getProduct()");
        $products = DB::table('product')
        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
        ->join('member', 'product.user_id', '=', 'member.Id')
        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock','product.Description','categoryproduct.Name as CategoryName','member.Username as ShopName')
        ->where('product.deleted', '= ', '0');
        return $products;
    }

    public function getProductListingSearchData(Request $request){
        $var_search = $request->query('var_search');
        $products = DB::table('product')
        ->join('categoryproduct', 'product.CategoryId', '=', 'categoryproduct.Id')
        ->join('member', 'product.user_id', '=', 'member.Id')
        ->select('product.Id', 'product.Name', 'product.Price', 'product.QuantityInStock','product.Description','categoryproduct.Name as CategoryName','member.Username as ShopName')
        ->where(function($query) use ($var_search) {
            $query->where('product.Name', 'like', '%' . $var_search . '%')
                  ->orWhere('product.Description', 'like', '%' . $var_search . '%')
                  ->orWhere('product.Id', 'like', '%' . $var_search . '%');
        })
        ->where('product.deleted', '= ', '0');
        return $products;
    }

    public function removeDetailProduct($id){
        DB::update('update product set deleted = 1 where Id = :ProductId', 
        [
            'ProductId' => $id,
        ]);

        DB::update('update comment set deleted = 1 where ProductId = :ProductId', 
        [
            'ProductId' => $id,
        ]);
    }
}
