<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Exception;

class UnlockMemberController extends Controller
{
    public function index(){
        $lockedmembers =  new Member();
        $lockedmembers =  $lockedmembers->getLockedMemberData();
        return view('Admin.unlockMember')->with('members',  $lockedmembers);
    }

    public function unlockMember($id){
        try{
            $lockedmembers = new Member();
            $lockedmembers->unlockMember($id);
            $message = 'Mở khóa tài khoản thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $message = 'Mở khóa tài khoản thất bại, lí do: ';
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $message.$ex->getMessage()]);
        }
        
        return redirect()->back();
    }

    public function search(Request $request){
        $lockedmembers =  new Member();
        $lockedmembers =  $lockedmembers->getLockedMemberSearchData($request);
        return view('Admin.unlockMember')->with('members',  $lockedmembers);
    }
}
