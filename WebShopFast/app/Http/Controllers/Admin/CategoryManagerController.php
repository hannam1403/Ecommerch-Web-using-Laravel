<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminCategoryManagerRequest;
use App\Http\Requests\AdminEditCategoryManagerRequest;
use App\Models\CategoryProduct;
use Exception;


class CategoryManagerController extends Controller
{
    public function index(){
        $categories = new CategoryProduct();
        $categories =  $categories->getDataForCategoryProduct()->paginate(10);
        return view('Admin.categoryManager',['categories' => $categories]);
    }

    public function search(Request $request){
        $categories = new CategoryProduct();
        $categories =  $categories->getDataForSearchCategoryProduct($request)->paginate(10);
        return view('Admin.categoryManager',['categories' => $categories]);
    }

    public function addCategory(AdminCategoryManagerRequest $request){
        try{
            $categories = new CategoryProduct();
            $categories->addCategory($request);
            $message = 'Thêm mới danh mục thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect()->back();
    }

    public function editCategory(AdminEditCategoryManagerRequest $request){
        try{
            $categories = new CategoryProduct();
            $categories->editCategory($request);
            $message = 'Sửa danh mục thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
       
        return redirect ('/CategoryManager');
    }

    public function deleteCategory($id){
        try{
            $product = new CategoryProduct();
            $product->deleteCategory($id);
            $message = 'Xóa danh mục thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect ('/CategoryManager');
    }
}
