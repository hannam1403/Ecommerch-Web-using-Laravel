<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{   
    use HasFactory;
    private $Id; 
    private $MemberId;  
    private $MemberName;
    private $ImageAvatar;  
    private $ProductId;  
    private $CreateAt;
    private $Content;


    /**
     * Get the value of Id
     */ 
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */ 
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * Get the value of MemberId
     */ 
    public function getMemberId()
    {
        return $this->MemberId;
    }

    /**
     * Set the value of MemberId
     *
     * @return  self
     */ 
    public function setMemberId($MemberId)
    {
        $this->MemberId = $MemberId;

        return $this;
    }

    /**
     * Get the value of ProductId
     */ 
    public function getProductId()
    {
        return $this->ProductId;
    }

    /**
     * Set the value of ProductId
     *
     * @return  self
     */ 
    public function setProductId($ProductId)
    {
        $this->ProductId = $ProductId;

        return $this;
    }

    /**
     * Get the value of CreateAt
     */ 
    public function getCreateAt()
    {
        return $this->CreateAt;
    }

    /**
     * Set the value of CreateAt
     *
     * @return  self
     */ 
    public function setCreateAt($CreateAt)
    {
        $this->CreateAt = $CreateAt;

        return $this;
    }

    /**
     * Get the value of Content
     */ 
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * Set the value of Content
     *
     * @return  self
     */ 
    public function setContent($Content)
    {
        $this->Content = $Content;

        return $this;
    }

    /**
     * Get the value of MemberName
     */ 
    public function getMemberName()
    {
        return $this->MemberName;
    }

    /**
     * Set the value of MemberName
     *
     * @return  self
     */ 
    public function setMemberName($MemberName)
    {
        $this->MemberName = $MemberName;

        return $this;
    }

    /**
     * Get the value of ImageAvatar
     */ 
    public function getImageAvatar()
    {
        return $this->ImageAvatar;
    }

    /**
     * Set the value of ImageAvatar
     *
     * @return  self
     */ 
    public function setImageAvatar($ImageAvatar)
    {
        $this->ImageAvatar = $ImageAvatar;

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

        DB::insert("insert into comment(MemberId, ProductId, Create_at, Content, deleted) values (:Member_Id, :ProductId, :Create_at, :Content, :deleted)",
        [
            'Member_Id' => $userId,
            'ProductId' => $productId,
            'Create_at' => $create_at,
            'deleted' => 0,
            'Content' => $commentValue
        ]);

        if( $user[0]->ava_img_path == null) {
            $user[0]->ava_img_path = 'defaultAvatarProfile.jpg';
        }

        $this->setMemberId($userId);
        $this->setImageAvatar($user[0]->ava_img_path);
        $this->setMemberName($user[0]->Name);
        $this->setProductId($productId);
        $this->setContent($commentValue);
        $this->setCreateAt($create_at);       
    }

    public function getCommentData(){

        // $products =  DB::select("CALL getProduct()");
        $comments = DB::table('comment')
        ->join('product', 'comment.ProductId', '=', 'product.Id')
        ->join('member', 'comment.MemberId', '=', 'member.Id')
        ->select('comment.Id', 'comment.Content', 'product.Id as ProductId','member.Username as User')
        ->where('comment.deleted', '= ', '0');
        return $comments;
    }

    public function removeComment($id){
        DB::update('update comment set deleted = 1 where Id = :CommentId', 
        [
            'CommentId' => $id,
        ]);
    }

    public function getCommentSearchData(Request $request){
        $var_search = $request->query('var_search');
        $comments = DB::table('comment')
        ->join('product', 'comment.ProductId', '=', 'product.Id')
        ->join('member', 'comment.MemberId', '=', 'member.Id')
        ->select('comment.Id', 'comment.Content','product.Id as ProductId','member.Username as User')
        
        ->where(function($query) use ($var_search) {
            $query->where('comment.Id', 'like', '%' . $var_search . '%')
                  ->orWhere('comment.Content', 'like', '%' . $var_search . '%');
        })
        ->where('comment.deleted', '= ', '0');
        return $comments;
    }
}
