<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use App\Models\ImageProduct;
use Exception;

class ReportProductManagerController extends Controller
{
    public function index(){
        $reports = DB::table('reportproduct')
                    ->select('reportproduct.Id as Id', 'reportproduct.MemberId as MemberId', 
                                'reportproduct.ProductId as ProductId', 'reportproduct.Content as Content', 
                                'product.Name as ProductName', 'product.Description as ProductDescription',
                                'product.Price as ProductPrice', 'member.Id as ShopId')
                    ->join('product', 'product.Id', '=', 'reportproduct.ProductId')
                    ->join('member', 'member.Id', '=', 'product.user_id')
                    ->get();

        
        return view('Admin.reportProductManager', compact('reports'));
    }

    public function GetDataProductById(Request $request) 
    {
        $ProductId =  $request->query('ProductId');

        $productData = DB::select("select product.Id, product.Name, product.Price, product.Description, product.CategoryId, product.user_id, product.QuantityInStock, member.Name 
        as NameShop from product join member on product.user_id = member.id where product.id = :id", 
        [
            "id" => $ProductId
        ]);

        $imagesData =  DB::select("select * from ImageProduct where ProductId = :ProductId", 
        [
            "ProductId" => $ProductId
        ]);
        return response()->json(['product' => $productData, 'images' => $imagesData]);
    }

    public function delete($id){
        try{
            DB::table('reportproduct')
            ->where('Id', $id)
            ->delete();
            $message = 'Xóa báo cáo thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' =>$ex->getMessage()]);
        }
        
        return redirect()->back();
    }
}
