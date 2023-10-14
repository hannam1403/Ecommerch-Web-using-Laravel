<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Redis;

class CommentManagerController extends Controller
{
    public function index(){
        $comments =  new Comment();
        $comments = $comments->getCommentData()->paginate(5);
        return view('Admin.commentManager', ['comments' =>  $comments]);
    }

    public function removeComment($id){
        $comments =  new Comment();
        $comments->removeComment($id);
        return redirect(('/CommentManager')); 
    }

    public function search(Request $request){
        $comments =  new Comment();
        $comments = $comments->getCommentSearchData($request)->paginate(5);
        return view('Admin.commentManager')->with('comments',  $comments);
    }

}

