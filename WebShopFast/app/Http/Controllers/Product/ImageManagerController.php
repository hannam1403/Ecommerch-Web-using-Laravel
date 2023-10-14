<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ImageProduct;
use Illuminate\Http\Request;
use App\Http\Requests\ProductImageManagerRequest;
use Exception;

class ImageManagerController extends Controller
{
    public function index(){
        $product = new ImageProduct();
        $products =  $product->getDataForImageManager()->paginate(5);
       
        return view('Shop.ImageProductManager', ['products' => $products, 'SearchValue' => null]);//->with('products',  $products);
    }

    public function search(Request $request) 
    {
        $SearchValue = $request->query('SearchValue');
        $product = new ImageProduct();
        $qr = $product->search($request);
        
        return view('Shop.ImageProductManager',[
            'SearchValue' => $SearchValue,
            'products' => $qr 
        ]);   
    }

    public function addImageProduct(ProductImageManagerRequest $request) {
        try{
            $product = new ImageProduct();
            $product->addImageProduct($request);
            $type = 'success';
            $message = 'Thêm mới hình ảnh thành công';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect('/ImageProductManager');
        
    }
    public function removeImageProduct($id) {
        try{
            $product = new ImageProduct();
            $product->removeImageProduct($id);
            $type = 'success';
            $message = 'Xóa hình ảnh thành công';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        
        return redirect()->back(); 
    }
}
