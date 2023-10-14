<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Session;

class Member extends Model
{   
    use HasFactory;
    public $Id;
    public $Name;  
    public $Gender;  
    public $Birthday; 
    public $Address; 
    public $Phone; 
    public $Username; 
    public $username; 
    public $Password; 
    public $Ava_img_path; 
    public $RoleUser;
    public $AccountBalance;

    public $userstatus;

    // Getter for Username
public function getUsername() {
    return $this->Username;
}

// Setter for Username
public function setUsername($Username) {
    $this->Username = $Username;
}
// Getter for Password
public function getPassword() {
    return $this->Password;
}

// Setter for Password
public function setPassword($Password) {
    $this->Password = $Password;
}

// Getter for RoleId
public function getRoleId() {
    return $this->RoleId;
}

// Setter for RoleId
public function setRoleId($RoleId) {
    $this->RoleId = $RoleId;
}

public function getUserStatus() {
    return $this->userstatus;
}

public function setUserStatus($userstatus) {
    $this->userstatus = $userstatus;
}


    public function getMemberData(){
        // $members =  DB::select("CALL getMemberInfo()");
        $members = DB::table('member')
        ->select('member.Id', 'member.Name', 'member.Phone', 'member.Username', 'member.AccountBalance','member.RoleId')
        ->where('member.userstatus', '=', '1');
        return $members;
    }

        public function getMemberSearchData(Request $request){
        $var_search = $request->query('var_search');
        $members = DB::table('member')
        ->select('member.Id', 'member.Name', 'member.Phone', 'member.Username', 'member.AccountBalance','member.RoleId')
        ->where(function($query) use ($var_search) {
            $query->where('member.Username', 'like', '%' . $var_search . '%')
                  ->orWhere('member.Id', 'like', '%' . $var_search . '%');
        })
        ->where('member.userstatus', '=', '1')
        ->paginate(10);
        return $members;
    }

    public function deleteMember(Request $request){
        $id = $request->input('Id');
        $reason = $request->input('reason');
        DB::table('member')
            ->where('Id', $id)
            ->update([
                'userstatus' => 0,
                'reasonLockId' => $reason
            ]);
        // DB::update('update member set userstatus = 0 and reasonLockId = :reason where Id= :MemberId',
        // [
        //     'MemberId' => $id,
        //     'reason' => $reason
        // ]);
    }

    public function getLockedMemberData(){
        $lockedmembers = DB::table('member')
        ->select('member.Id as Id', 'member.Name as Name', 'member.Phone as Phone', 
                    'member.Username as Username','member.AccountBalance as AccountBalance',
                    'member.RoleId as Role', 'reasonlock.Reason as Reason')
        ->join('reasonlock', 'member.reasonLockId', '=', 'reasonlock.Id')
        ->where('member.userstatus', '=', '0')
        ->paginate(10);
        return $lockedmembers;
    }

    public function getLockedMemberSearchData(Request $request){

        $var_search = $request->query('var_search');
        $lockedmembers = DB::table('member')
        ->select('member.Id', 'member.Name', 'member.Phone', 'member.Username','member.AccountBalance','member.RoleId as Role', 'reasonlock.Reason as Reason')
        ->join('reasonlock', 'member.reasonLockId', '=', 'reasonlock.Id')
        ->where('member.userstatus', '=', '0')
        ->where('member.Username', 'like', '%' . $var_search . '%')
        ->paginate(10);
        return $lockedmembers;
    }

    public function unlockMember($id){
        // DB::update('update member set userstatus = 1 where Id= :MemberId',
        // [
        //     'MemberId' => $id,
        // ]);
        DB::table('member')
            ->where('Id', $id)
            ->update([
                'userstatus' => 1,
                'reasonLockId' => null
            ]);
        return redirect(('/MemberManager'));
    }

    public function getDataDetailAccount() 
    {
        $user = new Member();
        $user_id = session('my_user_id');
        $query = DB::select("call GetAccountDetail(:id)", 
        [
                'id' => $user_id,
        ]);
        //dd($query);
        $user->id = $query[0]->Id;
        $user->name = $query[0]->Name;
        $user->gender = $query[0]->Gender;
        $user->birthday = $query[0]->Birthday;
        $user->address = $query[0]->Address;
        $user->phone = $query[0]->Phone;
        $user->username = $query[0]->Username;
        $user->password = $query[0]->Password;
        $user->ava_img_path = $query[0]->ava_img_path;
        $user->roleid = $query[0]->RoleID;
        $user->AccountBalance = $query[0]->AccountBalance;

        return $user;
    }  

    public function updateAccountDetail(Request $request, $id) 
    {
        $user_id = session('my_user_id');
        $query = DB::select("call GetAccountDetail(:id)", 
        [
                'id' => $user_id,
        ]);
        //dd("nhan thong tin tu deal user thanh cong"); 
        if($request->ImageAvatar == null) {
            $genaratedImageAvaName =  $query[0]->ava_img_path;
        }
        else {
            $genaratedImageAvaName = 'imageAva'.'-'.Session::get('my_user_id').'-'.$request->Username.'.'.$request->ImageAvatar->extension();
            $request->ImageAvatar->move(public_path('images/AvatarImage/'), $genaratedImageAvaName);
        }

        $user = new Member();
        $user->name = $request->Name;
        $user->gender = $request->Gender;
        $user->birthday = $request->Birthday;
        $user->address = $request->Address;
        $user->phone = $request->Phone;
        $user->username = $request->Username;
        $user->ava_img_path = $genaratedImageAvaName;
        $user->roleid = $request->RoleID;

        $affectedRows = DB::update('update member set Name = :Name, Gender = :Gender, 
            Birthday = :Birthday, Phone = :Phone, Username = :Username, 
            ava_img_path = :ImageAvatar where Id = :Id',
        [
            'Name' => $request->Name, 
            'Gender' => $request->Gender,
            'Birthday' => $request->Birthday,           
            'Phone' => $request->Phone,
            'Username' => $request->Username,
            'ImageAvatar' => $genaratedImageAvaName,
            'Id' => $id,
        ]);

        return $user;

                      
        if ($affectedRows > 0) {
            session(['Success' => "Cập nhật thành công"]);
        }   
    }

    public function showAccountDetail($id) 
    {
        //dd("hien thi thong tin tu deal user thanh cong"); 
        $user = new Member();
        $query = DB::select("call GetAccountDetail(:id)", 
        [
                'id' => $id,
        ]);
        //dd($query);
        $user->id = $query[0]->Id;
        $user->name = $query[0]->Name;
        $user->gender = $query[0]->Gender;
        $user->birthday = $query[0]->Birthday;
        $user->address = $query[0]->Address;
        $user->phone = $query[0]->Phone;
        $user->username = $query[0]->Username;
        $user->password = $query[0]->Password;
        $user->ava_img_path = $query[0]->ava_img_path;
        $user->roleid = $query[0]->RoleID;
        $user->AccountBalance = $query[0]->AccountBalance;

        return $user;
    }

    public function withdrawDetailAccount(Request $request){
        $user_id = Session::get('my_user_id');

        $member = DB::table('member')->where('Id', $user_id)->first();

        $accountBalance = $member->AccountBalance;

        $amount = $request->input("AmountMoneyWithdraw");

        if($amount > $accountBalance){
            session()->flash('error', 'Số tiền rút ra vượt quá số dư ví');
            return redirect()->back();
        }
        else{
            DB::table('member')
            ->where('Id', $user_id)
            ->decrement('AccountBalance', $amount);
            session()->flash('success', 'Rút tiền thành công');
        }
    }

    public function updateDetailShop(Request $request, $id) 
    {
        $query = DB::select(" call GetAccountDetail(:id)", 
        [
                'id' => $id,
        ]);
        //dd("nhan thong tin tu deal user thanh cong"); 
        if($request->ImageAvatar == null) {
            $genaratedImageAvaName = $query[0]->ava_img_path;
        }
        else {
            $genaratedImageAvaName = 'imageAva'.'-'.Session::get('my_user_id').'-'.$request->Username.'.'.$request->ImageAvatar->extension();
            $request->ImageAvatar->move(public_path('images/AvatarImage/'), $genaratedImageAvaName);
        }

        $user = new Member();
        $user->name = $request->Name;
        $user->gender = $request->Gender;
        $user->birthday = $request->Birthday;
        $user->address = $request->Address;
        $user->phone = $request->Phone;
        $user->username = $request->Username;
        $user->ava_img_path = $genaratedImageAvaName;

        $affectedRows = DB::update('update member set Name = :Name, Gender = :Gender, 
            Birthday = :Birthday, Address = :Address, Phone = :Phone, Username = :Username, 
            ava_img_path = :ImageAvatar where Id = :Id',
        [
            'Name' => $request->Name, 
            'Gender' => $request->Gender,
            'Birthday' => $request->Birthday,           
            'Address' => $request->Address, 
            'Phone' => $request->Phone,
            'Username' => $request->Username,
            'ImageAvatar' => $genaratedImageAvaName,
            'Id' => $id,
        ]);
                      
        if ($affectedRows > 0) {
            // Cập nhật thành công
            session(['Success' => "Cập nhật thành công"]);
        }
        // } else {
        //     // Cập nhật không thành công
        //     session(['Error' => "Cập nhật không thành công"]);
        // }
    }

    public function showDetailShop($id) 
    {
        //dd("hien thi thong tin tu deal user thanh cong"); 
        $user = new Member();
        $query = DB::select(" call GetAccountDetail(:id)", 
        [
                'id' => $id,
        ]);
        //dd($query);
        $user->id = $query[0]->Id;
        $user->name = $query[0]->Name;
        $user->gender = $query[0]->Gender;
        $user->birthday = $query[0]->Birthday;
        $user->address = $query[0]->Address;
        $user->phone = $query[0]->Phone;
        $user->username = $query[0]->Username;
        $user->password = $query[0]->Password;
        $user->ava_img_path = $query[0]->ava_img_path;
        $user->AccountBalance = $query[0]->AccountBalance;

        return $user;
    }
    public function withdrawDetailShop(Request $request){
        $user_id = Session::get('my_user_id');

        $member = DB::table('member')->where('Id', $user_id)->first();

        $accountBalance = $member->AccountBalance;

        $amount = $request->input("AmountMoney");

        if($amount > $accountBalance){
            session()->flash('error', 'Số tiền rút ra vượt quá số dư ví');
            return redirect()->back();
        }
        else{
            DB::table('member')
            ->where('Id', $user_id)
            ->decrement('AccountBalance', $amount);

            session()->flash('success', 'Rút tiền thành công');
        }
    }

    public function getDataForLogin(Request $request) 
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $roleid = $request->input('roleid');

        $user = DB::select("SELECT * FROM member where username = :username && password = :password", 
        [
                'username' => $username,
                'password' => $password
        ]);
        return $user;
    }

    public function getReasonLock(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $reasonlock = DB::table('reasonlock')
                            ->select('reasonlock.Reason as Reason')
                            ->join('member', 'member.reasonLockId', '=', 'reasonlock.Id')
                            ->where('member.username', $username)
                            ->where('member.password', $password)
                            ->first();
        
        return $reasonlock;
    }

    public function updatePassword(Request $request, $id)
    {

        $user = new Member();
        $query = DB::select("SELECT * FROM member where id = :id", 
        [
                'id' => $id,
        ]);
        $query1 = DB::select("SELECT Name FROM address where MemberId = :id", 
        [
                'id' => $id,
        ]);
        //dd($query);
        $user->id = $query[0]->Id;
        $user->name = $query[0]->Name;
        $user->address = $query1[0]->Name;
        $user->gender = $query[0]->Gender;
        $user->birthday = $query[0]->Birthday;
        $user->phone = $query[0]->Phone;
        $user->username = $query[0]->Username;
        $user->password = $query[0]->Password;
        $user->ava_img_path = $query[0]->ava_img_path;
        $user->roleid = $query[0]->RoleID;
        $user->AccountBalance = $query[0]->AccountBalance;

        return $user;
    }

    public function SaveDepositPayment(Request $request) {
        $user_id = session('my_user_id');
 
        $Transaction = DB::select("SELECT MAX(ID) as Id FROM moneytransaction");
        
        $vnp_Amount = $request->query('vnp_Amount') / 100;

        DB::update('update MoneyTransaction set Status = :Status where Id = :IdTransaction',
        [
            'Status' => 1, 
            'IdTransaction' => $Transaction[0]->Id
        ]);

        DB::table('deposit')->insert([
            'Member_Id' => $user_id,
            'AmountMoney' => $vnp_Amount 
        ]);

        $user = new Member();
        $query = DB::select("call GetAccountDetail(:id)", 
        [
                'id' => $user_id,
        ]);

        $user->id = $query[0]->Id;
        $user->name = $query[0]->Name;
        $user->gender = $query[0]->Gender;
        $user->birthday = $query[0]->Birthday;
        $user->address = $query[0]->Address;
        $user->phone = $query[0]->Phone;
        $user->username = $query[0]->Username;
        $user->password = $query[0]->Password;
        $user->ava_img_path = $query[0]->ava_img_path;
        $user->roleid = $query[0]->RoleID;
        $user->AccountBalance = $query[0]->AccountBalance;

        return $user;
    }

    public function VnpayPayment(Request $request) 
    {
        $IdTransaction  = DB::table('MoneyTransaction')->insertGetId([
            'Status' => 0,
        ]);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8081/VnpayPayment";
        $vnp_TmnCode = "YXP1VFN5";//Mã website tại VNPAY 
        $vnp_HashSecret = "ZEJSRNZQLXADGHBMOQOJRGPYTLQPSHCN"; //Chuỗi bí mật

        $vnp_TxnRef = $IdTransaction; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Nạp thẻ shop fast';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->input('AmountMoney') * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
       
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }  

    public function SaveDepositPayment_Shop(Request $request) {
        $user_id = session('my_user_id');
 
        $Transaction = DB::select("SELECT MAX(ID) as Id FROM moneytransaction");
        
        $vnp_Amount = $request->query('vnp_Amount') / 100;

        DB::update('update MoneyTransaction set Status = :Status where Id = :IdTransaction',
        [
            'Status' => 1, 
            'IdTransaction' => $Transaction[0]->Id
        ]);

        DB::table('deposit')->insert([
            'Member_Id' => $user_id,
            'AmountMoney' => $vnp_Amount 
        ]);

        $user = new Member();
        $user = $user->showDetailShop($user_id );

        return $user;
    }

    public function VnpayPayment_Shop(Request $request) 
    {
        $IdTransaction  = DB::table('MoneyTransaction')->insertGetId([
            'Status' => 0,
        ]);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8081/VnpayPaymentShop";
        $vnp_TmnCode = "YXP1VFN5";//Mã website tại VNPAY 
        $vnp_HashSecret = "ZEJSRNZQLXADGHBMOQOJRGPYTLQPSHCN"; //Chuỗi bí mật

        $vnp_TxnRef = $IdTransaction; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Nạp thẻ shop fast';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->input('AmountMoney') * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
       
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }  

    public function getRegisterData(Request $request){
        $user = new Member();
        $user->name = $request->input('Name');
        $user->gender = $request->input('Gender');
        $user->birthday = $request->input('Birthday');
        $user->address = $request->input('Address');
        $user->phone = $request->input('Phone');
        $user->username = $request->input('Username');
        $user->password = $request->input('Password');
        $user->roleid = $request->input('roleid');

        return $user;
    }

    public function insertRegisterData(Request $request){

        $user = new Member();
        $user = $user->getRegisterData($request);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date('Y-m-d');
        
        $id = DB::table('member')->insertGetId([
            'name' => $user->name,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'phone' => $user->phone,
            'username' => $user->username,
            'password' => $user->password,
            'roleid' => $user->roleid,
            'CreateAt' => $currentDate,
            'userstatus' => 1,
        ]);
        
        DB::insert("insert into address (MemberId, Name, Status) values (:member_id, :address, 1)", 
        [
            'member_id' => $id, 
            'address' => $user->address
        ]);

        return $id;
    }

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
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get the value of Phone
     */ 
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * Set the value of Phone
     *
     * @return  self
     */ 
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;

        return $this;
    }

    /**
     * Get the value of AccountBalance
     */ 
    public function getAccountBalance()
    {
        return $this->AccountBalance;
    }

    /**
     * Set the value of AccountBalance
     *
     * @return  self
     */ 
    public function setAccountBalance($AccountBalance)
    {
        $this->AccountBalance = $AccountBalance;

        return $this;
    }
}
