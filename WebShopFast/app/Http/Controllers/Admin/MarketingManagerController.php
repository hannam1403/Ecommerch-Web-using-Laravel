<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MarketingManagerRequest;
use Exception;

class MarketingManagerController extends Controller
{
    public function index(){
        $marketings = DB::table('marketing')
                        ->paginate(5);
        return view('Admin.MarketingManager', compact('marketings'));
    }
    public function search(Request $request){
        $var_search = $request->query('var_search');
        $marketings = DB::table('marketing')
                        ->where('marketing.Name', 'like', '%' . $var_search . '%')
                        ->paginate(5);
        return view('Admin.MarketingManager', compact('marketings'));
    }

    public function addMarketing(MarketingManagerRequest $request){
        try{
            $marketingname = $request->input('Name');
            $marketingprice = $request->input('Price');
            DB::table('marketing')->insertGetId([
                'Name' => $marketingname,
                'Price' => $marketingprice,
            ]);
            $message = 'Thêm mới phương thức marketing thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }

        return redirect()->back();
    }

    public function editMarketing(MarketingManagerRequest $request){
        try{
            $id = $request->input('idmarketing');
            $name = $request->input('Name');
            $price = $request->input('Price');
    
            DB::update('update marketing set Name = :Name, Price = :Price where Id = :Id ',
            [
                'Name' => $name,
                'Price' => $price,
                'Id' => $id,
            ]);
            $message = 'Cập nhật phương thức marketing thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect()->back();
    }

    public function deleteMarketing($id){
        DB::update('delete from marketing where Id = :Id', 
        [
            'Id' => $id,
        ]);

        DB::update('delete from marketingproduct where MarketingId = :Id',
        [
            'Id' => $id,
        ]);
        return redirect()->back();
    }
}
