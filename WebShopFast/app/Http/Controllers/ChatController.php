<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Chat;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ChatController extends Controller
{
    public function UserSendMessage(Request $request) 
    {
        $chat = new Chat();
        $chat = $chat->UserSendMessage($request);

        return response()->json([
            'imageAvatar' => $chat->getImageAvatar(), 
            'FromUserName' => $chat->getFromUserName(), 
            'FromUserId' => $chat->getFromUserId(), 
            'ToUserId' => $chat->getToUserId(), 
            'commentDate' => $chat->getcommentDate(),
            'commentContent' => $chat->getcommentContent()
        ]);
    }

    public function ChatSupportUser() 
    {
        return view("Shop.ChatSupportUser");
    }

    public function GetMessage(Request $request) 
    {
        $chat = new Chat();
        $chat = $chat->GetMessage($request);

        return response()->json([
            'FromUserId' => $chat->getFromUserId(),  
            'ToUserId' => $chat->getToUserId(), 
            'messages' => $chat->getMessages()
        ]);
    }

    public function GetBoxChat() {
        $my_user_id = session('my_user_id');
        $usersBoxChat = DB::select("SELECT A.*, B.AmountMessegeToUserUnseen 
                            FROM (
                                SELECT m1.*, member.Name, member.ava_img_path
                                FROM message m1
                                JOIN member ON m1.FromUserId = member.Id
                                WHERE m1.Id = (
                                    SELECT MAX(m2.Id) as MaxId
                                    FROM message m2
                                    WHERE m2.FromUserId = m1.FromUserId
                                ) AND m1.ToUserId = :id1
                            ) as A
                            LEFT JOIN (
                                SELECT m1.FromUserId, m1.ToUserId, COUNT(m1.ToUserId) as AmountMessegeToUserUnseen
                                FROM message m1
                                WHERE m1.ToUserId = :id2 AND m1.ToUserSeen = 0
                                GROUP BY m1.FromUserId, m1.ToUserId
                            ) as B ON A.FromUserId = B.FromUserId
                            WHERE B.AmountMessegeToUserUnseen IS NOT NULL", 
                            [
                                "id1" => $my_user_id ,
                                "id2" => $my_user_id ,
                            ]);

        return response()->json([
            'usersBoxChat' => $usersBoxChat
        ]);
    }

    public function UpdateSeen(Request $request) 
    {
        $FromUserId =  $request->query('FromUserId');
        $ToUserId =  $request->query('ToUserId');

        DB::table('message')
            ->where('FromUserId', "=", $FromUserId)
            ->where('ToUserId', "=", $ToUserId)
            ->where('ToUserSeen', "=", 0)
            ->update([
                'ToUserSeen'=> 1,
            ]);
            
        return response()->json([
            'FromUserId' => $FromUserId,
            'ToUserId' => $ToUserId,
        ]);
    }
}
