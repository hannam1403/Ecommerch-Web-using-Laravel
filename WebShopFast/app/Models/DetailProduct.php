<?php

namespace App\Models;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ImageProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{   
    use HasFactory;
    public $productId; 
    public $shop;  
    public $product;
    public $numberStar;  
    public $numberRatingAvg;  
    public $COUNT;
    public $TongTuongTac;
    public $TongSanPham;
    public $NgayThamGIa;

    public function GetDataForDetailProduct($id) 
    {
        //dd("hien thi thong tin tu deal user thanh cong"); 
        $user = DB::select('select * from member where id = :user_id', 
        [
            "user_id" => Session::get('my_user_id') 
        ]);


        $productData = DB::select("select product.Id, product.Name, product.Price, product.Description, product.CategoryId, product.user_id, product.QuantityInStock, member.Name 
        as NameShop from product join member on product.user_id = member.id where product.id = :id", 
        [
            "id" => $id
        ]);

        $product = new Product();
        $product->setId($productData[0]->Id);
        $product->setName($productData[0]->Name);
        $product->setPrice($productData[0]->Price);
        $product->setDescription($productData[0]->Description);
        $product->setCategoryId($productData[0]->CategoryId);
        $product->setShopId($productData[0]->user_id);
        $product->setOwnerProduct($productData[0]->NameShop);
        $product->setQuantityInStock($productData[0]->QuantityInStock);

        $shop = DB::select('select * from member where id = :user_id', 
        [
            "user_id" => $productData[0]->user_id
        ]);

        $imagesData =  DB::select("select * from ImageProduct where ProductId = :ProductId", 
        [
            "ProductId" => $id
        ]);

        foreach ($imagesData as $image) {
            $imageProduct = new ImageProduct();
            $imageProduct->setId($image->Id);
            $imageProduct->setImgProductPath($image->ImgProductPath);
            $imageProduct->setProductId($image->ProductId);
            $product->addImage($imageProduct);
        }

        $commentData = DB::table('comment')
            ->join('member', 'comment.MemberId', '=', 'member.Id')
            ->select('comment.Id as CommentId', 'comment.MemberId', 'comment.ProductId', 'comment.Create_at', 'comment.Content', 'member.*')
            ->where('comment.ProductId', '=', $id)
            ->where('comment.deleted', '=', '0')
            ->orderBy('comment.Id', 'DESC')
            ->paginate(1);
        
        $product->addComment($commentData);
        
        $dataRating = DB::select("SELECT star FROM rating WHERE ProductId = :productId and MemberId  = :user_id", 
        [
            'productId' => $productData[0]->Id,
            'user_id' => Session::get('my_user_id') 
        ]);

        $dataRatingAvg = DB::select("SELECT ProductId, AVG(star) As AVG FROM rating WHERE ProductId = :productId GROUP BY ProductId", 
        [
            'productId' => $productData[0]->Id
        ]);

        $dataCountRating = DB::select("SELECT count(ProductId) as COUNT FROM rating WHERE ProductId = :productId GROUP BY ProductId", 
        [
            'productId' => $productData[0]->Id
        ]);

        $dataTongComment = DB::select("SELECT count(comment.MemberId) as TongComment FROM member join product on member.Id = product.user_id join comment on comment.ProductId = product.Id WHERE member.Id = :MemberId", 
        [
            'MemberId' => $productData[0]->user_id
        ]);

        $dataTongRating= DB::select("SELECT COUNT(rating.MemberId) as TongRating FROM member join product on member.Id = product.user_id join rating on rating.ProductId = product.Id WHERE member.Id = :MemberId", 
        [
            'MemberId' => $productData[0]->user_id
        ]);

        $dataTongProduct = DB::select("SELECT count(product.Id) as TongSoSP FROM member JOIN product on member.Id = product.user_id WHERE member.id = :MemberId", 
        [
            'MemberId' => $productData[0]->user_id
        ]);

        if (empty($dataTongProduct)) {
            $TongProduct = 0;
        } 
        else {
            $TongProduct = $dataTongProduct[0]->TongSoSP;
        }


        if (empty($dataTongComment)) {
            $TongComment = 0;
        } 
        else {
            $TongComment = $dataTongComment[0]->TongComment;
        }

        if (empty($dataTongRating)) {
            $TongRating = 0;
        } 
        else {
            $TongRating = $dataTongRating[0]->TongRating;
        }

        $tongTuongTacShop = $TongComment + $TongRating;

        if (empty($dataRating)) {
            $numberStar = null;
        } 
        else {
            $numberStar = $dataRating[0]->star;
        }

        if (empty($dataRatingAvg)) {
            $numberRatingAvg = null;
        } 
        else {
            $numberRatingAvg =  round($dataRatingAvg[0]->AVG, 0, PHP_ROUND_HALF_DOWN);
        }

        if (empty($dataCountRating)) {
            $numberCountRating = 0;
        } 
        else {
            $numberCountRating = $dataCountRating[0]->COUNT;
        }
        //dd($dataCountRating);
        $dataNgayThamGiaShop = DB::select("SELECT CreateAt FROM member  WHERE member.id = :MemberId", 
        [
            'MemberId' => $productData[0]->user_id
        ]);

        $this->productId = $productData[0]->Id;
        $this->shop = $shop[0]; 
        $this->product = $product;
        $this->numberStar = $numberStar;  
        $this->numberRatingAvg = $numberRatingAvg;  
        $this->COUNT = $numberCountRating;
        $this->TongTuongTac = $tongTuongTacShop;
        $this->TongSanPham = $TongProduct;
        $this->NgayThamGIa = $dataNgayThamGiaShop[0]->CreateAt;  

        return $this;
    }

    public function SaveComment(Request $request) 
    {
        $userId =  $request->Input('userId');
        $productId =  $request->Input('productId');
        $commentValue =  $request->Input('commentValue');
        $create_at =  $request->Input('create_at');

        $user = DB::select('select * from member where id = :user_id', 
        [
             "user_id" => $userId
        ]);

        DB::insert("insert into comment(MemberId, ProductId, Create_at, Content) values (:Member_Id, :ProductId, :Create_at, :Content)",
        [
            'Member_Id' => $userId,
            'ProductId' => $productId,
            'Create_at' => $create_at,
            'Content' => $commentValue
        ]);

        if( $user[0]->ava_img_path == null) {
            $user[0]->ava_img_path = 'defaultAvatarProfile.jpg';
        }

        return response()->json([
            'imageAvatar' => $user[0]->ava_img_path, 
            'userName' => $user[0]->Name, 
            'commentDate' => $create_at,
            'commentContent' => $commentValue
        ]);
    }
    
}
