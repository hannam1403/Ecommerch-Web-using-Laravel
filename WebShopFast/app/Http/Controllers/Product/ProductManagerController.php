<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductManagerRequest;
use App\Http\Requests\ProductEditManagerRequest;
use Exception;

class ProductManagerController extends Controller
{
    public function index()
    {
        $product = new Product();
        $products =  $product->getDataForProductManager();
        //dd($products);
        return view('Shop.ProductManager', [
            'products' => $products,
            'SearchValue' => null,
            'typeSearch' => 0,
            'IsSortAsc' => true,
            'TypeColumn' => 0
        ]);
    }

    public function search(Request $request) 
    {
        $SearchValue = $request->query('SearchValue');
        $typeSearch =  $request->query('typeSearch');
        $product = new Product();
        $qr = $product->search($request);

        return view('Shop.ProductManager',[
            'SearchValue' => $SearchValue,
            'typeSearch' => $typeSearch,
            'IsSortAsc' => true,
            'TypeColumn' => 0,
            'products' => $qr 
        ]);   
    }

    public function sort(Request $request) 
    {
        $IsSortAsc = $request->query('IsSortAsc');
        $TypeColumn =  $request->query('TypeColumn');
        $product = new Product();
        $qr = $product->sort($request);


        return view('Shop.ProductManager',[
            'SearchValue' => "",
            'typeSearch' => 0,
            'IsSortAsc' => (bool)$IsSortAsc,
            'TypeColumn' => $TypeColumn,
            'products' => $qr 
        ]);   
    }

    public function addProduct(ProductManagerRequest $request) 
    {      
        try {
            $product = new Product();
            $product->addProduct($request);
            $message = 'Thêm mới Sản Phẩm thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        
        return redirect('/ProductManager');
    }

    public function EditProduct(ProductEditManagerRequest $request) 
    {
        try {
            $product = new Product();
            $product->EditProduct($request);
            $message = 'Cập nhật Sản Phẩm thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect('/ProductManager');
    }

    public function removeProduct($id) {
        try {
            $product = new Product();
            $product->removeProduct($id);
            $message = 'Xóa Sản Phẩm thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex) {
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect(('/ProductManager')); 
    }

    public function GetSubCategoryByCategory($IdCategory) 
    {
        $subcategories = DB::table('subcategory')                          
                            ->where('CategoryId', $IdCategory)
                            ->get();

        return response()->json(['subcategories' => $subcategories]);
    }
}
