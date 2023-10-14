<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProduct extends Model
{   
    use HasFactory;
    public $Id; 
    public $Name;  

    public function getDataForCategoryProduct(){
        $categories = DB::table('subcategory')
        ->join('categoryproduct', 'subcategory.CategoryId', '=', 'categoryproduct.Id')
        ->select('subcategory.Id', 'subcategory.Name', 'categoryproduct.Id as categoryId','categoryproduct.Name as categoryName');
        return $categories;
    }

    public function getDataForSearchCategoryProduct(Request $request){

        $var_search = $request->query('var_search');
        $categories = DB::table('subcategory')
        ->join('categoryproduct', 'subcategory.CategoryId', '=', 'categoryproduct.Id')
        ->select('subcategory.Id', 'subcategory.Name', 'categoryproduct.Id as categoryId','categoryproduct.Name as categoryName')
        ->where(function($query) use ($var_search) {
            $query->where('subcategory.Id', 'like', '%' . $var_search . '%')
                  ->orWhere('subcategory.Name', 'like', '%' . $var_search . '%');
        });
        return $categories;
    }
    
    public function editCategory(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');

        DB::update('update subcategory set Name = :Name where Id = :Id ',
        [
            'Name' => $name,
            'Id' => $id
        ]);
    }
    public function deleteCategory($id){
        DB::update('delete from subcategory where Id = :CategoryId', 
        [
            'CategoryId' => $id,
        ]);
    }

    public function addCategory(Request $request){
        $subcategoryName = $request->input('Name');
        $categoryId = $request->input('category');
        DB::table('subcategory')->insertGetId([
            'Name' => $subcategoryName,
            'CategoryId' => $categoryId,
        ]);
    }
}

