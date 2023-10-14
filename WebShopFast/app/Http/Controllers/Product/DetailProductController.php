<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\rating;
use App\Models\DetailProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;

class DetailProductController extends Controller
{
    public function GetData($id) 
    {
        $detailProduct = new DetailProduct();
        
        $detailProduct = $detailProduct->GetDataForDetailProduct($id);
        

        return view('Product.detailProduct')
            ->with('productId', $detailProduct->productId)
            ->with('shop', $detailProduct->shop)
            ->with('product', $detailProduct->product)
            ->with('numberStar', $detailProduct->numberStar)
            ->with('numberRatingAvg', $detailProduct->numberRatingAvg)
            ->with('COUNT', $detailProduct->COUNT)
            ->with('TongTuongTac', $detailProduct->TongTuongTac)
            ->with('TongSanPham', $detailProduct->TongSanPham)
            ->with('NgayThamGIa', $detailProduct->NgayThamGIa);
    }

    public function Comment_Pagination(Request $request) 
    {
        $ProductId = $request->query('ProductId');

        $commentData = DB::table('comment')
                ->join('member', 'comment.MemberId', '=', 'member.Id')
                ->select('comment.Id as CommentId', 'comment.MemberId', 'comment.ProductId', 'comment.Create_at', 'comment.Content', 'member.*')
                ->where('comment.ProductId', '=', $ProductId)
                ->orderBy('comment.Id', 'DESC')
                ->where('comment.deleted', '=', '0')
                ->paginate(1);

        
        return response()->json(['commentData' => $commentData]);
    }

    public function SaveComment(Request $request) 
    {
        $comment = new Comment();
        $comment->SaveComment($request);

        return response()->json([
            'imageAvatar' => $comment->getImageAvatar(), 
            'userName' => $comment->getMemberName(), 
            'commentDate' => $comment->getCreateAt(),
            'commentContent' => $comment->getContent()
        ]);
    }

    public function SaveRating(Request $request) 
    {
        $rating = new rating();
        $rating->SaveRating($request);
        return response()->json([
            'ratingValue' => $rating->getStar()
        ]);
    }

    public function ReportProduct(Request $request) 
    {
        $ProductId =  $request->Input('ReportProductId');
        $MemberId =  $request->Input('ReportMemberId');
        $Content =  $request->Input('inputReportContent');

        // dd([
        //     'ProductId' => $ProductId,
        //     'MemberId' => $MemberId,
        //     'Content' => $Content,
        // ]);

        try {
            DB::table('reportproduct')->insert([
                'MemberId'=> $MemberId,
                'ProductId'=> $ProductId,
                'Content'=> $Content,
            ]);

            $message = 'Báo cáo sản phẩm thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
   
        return redirect()->back();
    }

    public function ReportComment(Request $request) 
    {
        $CommentId =  $request->Input('ReportCommentId');
        $MemberId =  $request->Input('ReportMemberId');
        $Content =  $request->Input('inputReportContent');

        // dd([
        //     'CommentId' => $CommentId,
        //     'MemberId' => $MemberId,
        //     'Content' => $Content,
        // ]);

        try {
            DB::table('reportcomment')->insert([
                'MemberId'=> $MemberId,
                'CommentId'=> $CommentId,
                'Content'=> $Content,
            ]);

            $message = 'Báo cáo bình luận thành công';
            $type = 'success';
            Session()->flash('toastr', ['type' => $type, 'message' => $message]);
        } 
        catch (Exception $ex){
            $type = 'error';
            Session()->flash('toastr', ['type' => $type, 'message' => $ex->getMessage()]);
        }
   
        return redirect()->back();
    }
}