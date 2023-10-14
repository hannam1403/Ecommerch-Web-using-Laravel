<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Member;
use Exception;

class MemberManagerController extends Controller
{
    public function index(){
        $members =  new Member();
        $members = $members->getMemberData()->paginate(5);
        return view('Admin.memberManager', ['members' =>  $members]);
    }

    public function deleteMember(Request $request){
        try{
            $members = new Member();
            $members = $members->deleteMember($request);
            $message = ' Khóa tài khoản thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $message = 'Có lỗi trong quá trình khóa, lỗi: ';
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $message.$ex->GetMessage()]);
        }
        
        return redirect()->back();
    }

    public function search(Request $request){
        
        $members =  new Member();
        $members = $members->getMemberSearchData($request);
        return view('Admin.memberManager', ['members' =>  $members]);
        // dd($member);
    }

}
