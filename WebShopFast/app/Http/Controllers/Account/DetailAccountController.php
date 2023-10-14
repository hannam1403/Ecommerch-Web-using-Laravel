<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class DetailAccountController extends Controller
{
    public function index() 
    {
        $user = new Member();
        $user = $user->getDataDetailAccount();
        return view('Account.Detail')->with('user', $user);
    }   

    public function update(Request $request, $id) 
    {
        try{
            $user = new Member();
            $user->updateAccountDetail($request, $id);
            $message = 'Cập nhật thông tin thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect()->back();
    }

    public function show($id) 
    {
        $user = new Member();
        $user = $user->showAccountDetail($id);
        return view('Account.Detail')->with('user', $user);
    }

    public function withdraw(Request $request){
        try{
            $user = new Member();
            $user->withdrawDetailAccount($request);
            $message = 'Rút tiền thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
        return redirect()->back();
    }
}
