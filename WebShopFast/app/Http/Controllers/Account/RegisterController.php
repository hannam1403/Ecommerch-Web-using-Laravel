<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('Account.register');
    }

    public function store(Request $request) 
    {
        $username = $request->input('Username');
        $check = DB::table('member')
                ->where('Username', $username)
                ->get();
        $user = new Member();
        $user = $user->getRegisterData($request);
        try {
            if(count($check)>0){
                $message = 'Trùng tên đăng nhập';
                $type = 'error';
                Session()->flash('toastr', ['type' => $type, 'message' => $message]);
                return redirect()->back();
            }
            else{
                $id = new Member();
                $id = $id->insertRegisterData($request);
                $message = 'Đăng ký thành công, mời đăng nhập lại';
                $type = 'success';
                Session()->flash('toastr', ['type' => $type, 'message' => $message]);
            }        
        }
        catch(Exception $e) {
            session(['Error' => "Đăng ký không thành công, hãy điền đẩy đủ trên form đăng ký"]);
            return redirect()->back();
        }

        session(['my_user_id' => $id]);
        session(['username' => $user->name]);
        session(['Success' => "Đăng ký thành công"]);
        return redirect('/login');           
    }
}
