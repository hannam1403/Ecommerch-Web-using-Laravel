<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rating extends Model
{
    use HasFactory;
    private $Id;
    private $MemberId;  
    private $ProductId;  
    private $star;

	public function getId() {
		return $this->Id;
	}

    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }


    public function getMemberId()
    {
        return $this->MemberId;
    }

	public function setMemberId($MemberId) {
        $this->MemberId = $MemberId;
        return $this;
	}

    public function getProductId()
    {
        return $this->ProductId;
    }
    public function setProductId($ProductId)
    {
        $this->ProductId = $ProductId;

        return $this;
    }
    public function getStar()
    {
        return $this->star;
    }
    public function setstar($star)
    {
        $this->star = $star;

        return $this;
    }




    public function SaveRating(Request $request) 
    {
        $userId =  $request->Input('userId');
        $productId =  $request->Input('productId');
        $ratingValue =  $request->Input('ratingValue');

        $data = DB::select("SELECT COUNT(Id) as Count FROM rating WHERE ProductId = :productId and MemberId  = :user_id", 
        [
            'productId' => $productId,
            'user_id' => $userId
        ]);

        if($data[0]->Count == 0) {
            DB::insert("INSERT INTO rating (MemberId, productId, star) 
                VALUES (:user_id, :productId, :star)", 
            [
                'user_id' => $userId,
                'productId' => $productId,
                'star' => $ratingValue
            ]);
        }
        else {
            DB::update("update rating set star = :star where MemberId = :user_id and ProductId = :productId", [
                'star' => $ratingValue,
                'user_id' => $userId,
                'productId' => $productId
            ]);
        }
        $this->setMemberId($userId);
        $this->setProductId($productId);
        $this->setstar($ratingValue); 
    }
}
