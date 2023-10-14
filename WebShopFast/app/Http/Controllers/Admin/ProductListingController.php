<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;

class ProductListingController extends Controller
{
    public function index(){
        $products =  new Product();
        $products = $products->getProductListingData()->paginate(5);

        return view('Admin.productListingManager', ['products' =>  $products]);
    }

    public function removeDetailProduct($id){
        $products = new Product();
        $products->removeDetailProduct($id);
        return redirect(('/ProductListingManager')); 
    }

    public function search(Request $request){
        $products = new Product();
        $products = $products->getProductListingSearchData($request)->paginate(5);
        return view('Admin.productListingManager')->with('products',  $products);
    }

}
