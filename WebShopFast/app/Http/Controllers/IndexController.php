<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MarketingProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() 
    {
        $role_user_id = session('role_user_id');
        // /dd($role_user_id);
        if($role_user_id == 3) {
            return view('Shop.shopHome');
        } elseif($role_user_id ==1){
            return view('Admin.adminHome');
        }
        else {
            $dataMarketings =  DB::select("SELECT * FROM marketing order by Price desc");
            $listMarketingProduct = array();
            foreach($dataMarketings as $dataMarketing) { 
                $marketingProduct = new MarketingProduct();
                $marketingProduct->IdMarketing = $dataMarketing->Id;
                $marketingProduct->setNameMakerting($dataMarketing->Name);
                $dataProducts = DB::table('product')
                            ->join('marketingproduct', 'product.id', '=', 'marketingproduct.productId')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->where('marketingproduct.MarketingId', $dataMarketing->Id)
                            ->where('marketingproduct.Status', '=', 1)
                            ->where('product.deleted', 0)
                            ->select('product.*', 'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->paginate(5);

                $marketingProduct->setProducts($dataProducts);   
                $listMarketingProduct[] = $marketingProduct;    
            }

            $dataProducts = DB::table('product')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->select('product.Id', 'product.Name', 'product.Price', 'product.Description', 
                                'product.CategoryId', 'product.user_id', 'product.QuantityInStock', 
                                'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->where('product.deleted', 0)
                            ->orderByDesc('product.Id')
                            ->paginate(12);
            
                            
            $banners =  DB::select("CALL getBanner()");


            return view('index')->with(['var_search' => null, 'banners' => $banners, 'dataProducts' => $dataProducts, 'listMarketingProduct' => $listMarketingProduct]);
        }
    }

    public function IndexNewProduct_Pagination(Request $request) 
    {
        $dataProducts = DB::table('product')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->select('product.Id', 'product.Name', 'product.Price', 'product.Description', 
                                'product.CategoryId', 'product.user_id', 'product.QuantityInStock', 
                                'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->where('product.deleted', 0)
                            ->orderByDesc('product.Id')
                            ->paginate(12);

        return response()->json(['dataProducts' => $dataProducts]);
    }

    public function IndexMarketing_Pagination(Request $request) 
    {
        $marketing_id = $request->query('marketing_id');

        
        $dataProducts = DB::table('product')
                            ->join('marketingproduct', 'product.id', '=', 'marketingproduct.productId')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->where('marketingproduct.MarketingId', $marketing_id)
                            ->where('marketingproduct.Status', '=', 1)
                            ->where('product.deleted', 0)
                            ->select('product.*', 'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->paginate(4);
                  

        return response()->json(['dataProducts' => $dataProducts, 'marketing_id' => $marketing_id]);
    }

    public function search(Request $request){
        $var_search = $request->query('var_search');
        $listMarketingProduct = array();

        if(empty( $var_search)) {
            return redirect("/");
        }
        else 
        {
            $products = DB::table('product')
            ->leftJoinSub(
                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                'first_image',
                function ($join) {
                    $join->on('product.Id', '=', 'first_image.productId');
                }
            )
            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
            ->select('product.Id', 'product.Name', 'product.Price', 'product.Description', 
                'product.CategoryId', 'product.user_id', 'product.QuantityInStock', 
                'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
            ->where('product.deleted', 0)
            ->where('product.name', 'LIKE', '%' . $var_search . '%')
            ->paginate(4);

            $banners =  DB::select("CALL getBanner()");


            return view('index')->with(['var_search' => $var_search, 'banners' => $banners, 'dataProducts' => $products, 'listMarketingProduct' => $listMarketingProduct]);
        }        
    }

    public function showByType($type)
    {
        $var_search = null;
        $subtypes = DB::select("SELECT * FROM subcategory where CategoryId = :CategoryId",
        [
            "CategoryId" =>$type
        ]);

        $products = DB::table('product')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->select('product.Id', 'product.Name', 'product.Price', 'product.Description', 
                                'product.CategoryId', 'product.user_id', 'product.QuantityInStock', 
                                'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->where('product.deleted', 0)
                            ->where('product.CategoryId', '=', $type)
                            ->paginate(4);

        return view('indexShowByType', compact('var_search', 'products', 'type', 'subtypes'));
    }

    public function showBySubType($type, $subtype)
    {
        $var_search = null;
        $products = DB::table('product')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->select('product.Id', 'product.Name', 'product.Price', 'product.Description', 
                                'product.CategoryId', 'product.user_id', 'product.QuantityInStock', 
                                'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->where('product.deleted', 0)
                            ->where('product.CategoryId', '=', $type)
                            ->where('product.SubCategoryId', '=', $subtype)
                            ->paginate(4);

        $subtypes = DB::select("SELECT * FROM subcategory where CategoryId = :CategoryId",
        [
            "CategoryId" =>$type
        ]);

        return view('indexShowBySubType', compact('var_search', 'products','type', 'subtypes'));
    }
}