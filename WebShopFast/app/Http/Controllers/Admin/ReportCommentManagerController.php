<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Exception;

class ReportCommentManagerController extends Controller
{
    public function index(){
        $reports = DB::table('reportcomment')
                    ->select('reportcomment.Id as Id', 'reportcomment.MemberId as MemberId', 'member.Id as ReportedMemberId', 'reportcomment.CommentId as CommentId', 'reportcomment.Content as Content', 'comment.Content as Comment')
                    ->join('comment', 'comment.Id', '=', 'reportcomment.CommentId')
                    ->join('member', 'comment.MemberId', '=', 'member.Id')
                    ->where('comment.deleted', '=', '0')
                    ->get();
        return view('Admin.reportCommentManager', compact('reports'));
    }

    public function delete($id){
        try{
            DB::table('reportcomment')
            ->where('Id', $id)
            ->delete();
            $message = 'Xóa báo cáo thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        }
        catch(Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' =>$ex->getMessage()]);
        }
        
        return redirect()->back();
    }
}
