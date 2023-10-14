<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Chat extends Model
{
    use HasFactory;
    private $imageAvatar;
    private $FromUserName;
    private $FromUserId;
    private $ToUserId;
    private $commentDate;
    private $commentContent;
    private $messages;
    private $ToUserSeen;

    public function getImageAvatar()
    {
        return $this->imageAvatar;
    }

    public function setImageAvatar($imageAvatar)
    {
        $this->imageAvatar = $imageAvatar;
    }

    public function getFromUserName()
    {
        return $this->FromUserName;
    }

    public function setFromUserName($FromUserName)
    {
        $this->FromUserName = $FromUserName;
    }

    public function getFromUserId()
    {
        return $this->FromUserId;
    }

    public function setFromUserId($FromUserId)
    {
        $this->FromUserId = $FromUserId;
    }

    public function getToUserId()
    {
        return $this->ToUserId;
    }

    public function setToUserId($ToUserId)
    {
        $this->ToUserId = $ToUserId;
    }

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    public function getCommentContent()
    {
        return $this->commentContent;
    }

    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    public function getToUserSeen()
    {
        return $this->ToUserSeen;
    }

    public function setToUserSeen($ToUserSeen)
    {
        $this->ToUserSeen = $ToUserSeen;
    }

    public function UserSendMessage(Request $request) 
    {
        $FromUserId =  $request->Input('FromUserId');
        $ToUserId =  $request->Input('ToUserId');
        $BodyMessageValue =  $request->Input('BodyMessageValue');
        $CreateAt =  $request->Input('CreateAt');
        $ToUserSeen = 0;

        DB::table('message')->insert([
            'FromUserId' => $FromUserId,
            'ToUserId' => $ToUserId,
            'Body' => $BodyMessageValue,
            'CreateAt' => $CreateAt,
            'ToUserSeen' => $ToUserSeen
        ]);

        $user = DB::select('select * from member where id = :user_id', 
        [
             "user_id" => Session::get('my_user_id') 
        ]);

        if( $user[0]->ava_img_path == null) {
            $user[0]->ava_img_path = 'defaultAvatarProfile.jpg';
        }

        $this->setImageAvatar($user[0]->ava_img_path);
        $this->setFromUserName($user[0]->Name);
        $this->setFromUserId($FromUserId);
        $this->setToUserId($ToUserId);
        $this->setCommentDate($CreateAt);
        $this->setCommentContent($BodyMessageValue);
        $this->setToUserSeen($ToUserSeen);
        return $this;
    }

    public function GetMessage(Request $request) 
    {
        $FromUserId =  $request->Input('FromUserId');
        $ToUserId =  $request->Input('ToUserId');
        $lastId =  $request->Input('lastId');

        $messages = DB::select('select message.*, member.Name, member.ava_img_path 
                                from message 
                                join member
                                on message.FromUserId = member.Id
                                where 
                                ((FromUserId = :FromUserId1 and ToUserId = :ToUserId1) or (FromUserId = :FromUserId2 and ToUserId = :ToUserId2))
                                and message.Id > :lastId
                                order by message.Id', 
            [
                 "FromUserId1" => $FromUserId,
                 "ToUserId1" => $ToUserId,
                 "FromUserId2" => $ToUserId,
                 "ToUserId2" => $FromUserId,
                 "lastId" => $lastId,
            ]);

        $this->setMessages($messages);
        $this->setFromUserId($FromUserId);
        $this->setToUserId($ToUserId);


        return $this;
    }


    
}
