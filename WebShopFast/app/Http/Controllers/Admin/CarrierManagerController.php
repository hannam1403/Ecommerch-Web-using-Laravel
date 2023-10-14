<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Http\Requests\CarrierManagerRequest;
use Exception;

class CarrierManagerController extends Controller
{
    public function index(){
        $carriers = new Carrier();
        $carriers = $carriers->getCarrierData()->paginate(5);
        return view('Admin.carrierManager',['carriers' => $carriers]);
    }

    public function search(Request $request){
        $carriers = new Carrier();
        $carriers = $carriers->getCarrierSearchData($request)->paginate(5);
        return view('Admin.carrierManager',['carriers' => $carriers]);
    }

    public function addCarrier(CarrierManagerRequest $request){
        try{
            $carriers = new Carrier();
            $carriers->addCarrier($request);
            $message = 'Thêm mới đơn vị vận chuyển thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }

        return redirect('/CarrierManager');
    }


    public function editCarrier(CarrierManagerRequest $request) {
        try{
            $carriers = new Carrier();
            $carriers->editCarrier($request);
            $message = 'Cập nhật đơn vị vận chuyển thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }

        return redirect('/CarrierManager');
    }
    public function deleteCarrier($id){
        try{
            $carriers = new Carrier();
            $carriers->deleteCarrier($id);
        }
        catch(Exception $ex) {
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect(('/CarrierManager'));
    }
}
