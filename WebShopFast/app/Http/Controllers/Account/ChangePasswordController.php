<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('Account.change-password');
    }
    public function __invoke()
    {

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = new Member();
        $user = $user->updatePassword($request, $id);
        $old_pass = $user->password;

        if($request->input('current_password') != $old_pass) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $affectedRows = DB::update('update member set Password = :new_password where Id = :Id',
        [
            'new_password' => $request->input('new_password'),
            'Id' => $id,
        ]);
        if ($affectedRows > 0) {
            // Cập nhật thành công
            session(['Success' => "Cập nhật thành công"]);
        }
        return view('Account.Detail')->with('user', $user);
    }
    
    public function show($id)
    {
        
        return view('Account.change-password');
    }

}

