<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    //
    public function index() 
    {
        return view('Account.login');
    }

    public function store(Request $request) 
    {
       //dd("dang nhap thanh cong");       
        $user = new Member();
        $user = $user->getDataForLogin($request);

        $reasonlock = new Member();
        $reasonlock = $reasonlock->getReasonLock($request);

        //dd($user);
        if(count($user) == 1) {
            if(!$reasonlock){
                session(['my_user_id' => $user[0]->Id]);
                session(['role_user_id' => $user[0]->RoleID]);
                session(['username' => $user[0]->Name]);
                session(['userstatus' => $user[0]->userstatus]);
                $message = 'Đăng nhập thành công';
                $type = 'success';
                Session()->flash('toastr', ['type' => $type, 'message' => $message]);

                $userstatus = $user[0]->userstatus;
                $roleid =  $user[0]->RoleID;

                if($roleid == 3 && $userstatus ==1){
                    return redirect('shopHome');
                }
                elseif ($roleid == 2 && $userstatus ==1){
                    return redirect('/');   
                }
                return redirect('/');
            }
            else{
                if(count($user) ==1){
                    $userstatus = $user[0]->userstatus;
                    $reasonlockmes = $reasonlock->Reason;
                    if ($userstatus == 0) {
                        session(['Error' => "<center>Để biết thêm thông tin chi tiết, xin vui lòng liên hệ địa chỉ gmail: shopfast@gmail.com</center>"]);
                        $message = 'Tài khoản của bạn đã bị khóa. Lí do: ';
                        $type = 'error';
                        Session()->flash('toastr', ['type' => $type, 'message' => $message.$reasonlockmes]);
                        return redirect()->back();
                    }
    
                    // if($roleid == 3 && $userstatus ==1){
                    //     return redirect('shopHome');
                    // }
                    // elseif ($roleid == 2 && $userstatus ==1){
                    //     return redirect('/');   
                    // }
                    // return redirect('/');
                } 
            }
        }
        else {
            $message = 'Đăng nhập không thành công';
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
            return redirect()->back();
        };
    }
}
