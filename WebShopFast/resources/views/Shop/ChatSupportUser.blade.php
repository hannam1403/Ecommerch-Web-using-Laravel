@extends('Shop.Layouts.layoutManager')
<style>
    .BoxChat {
        background-color: #CDC4F9;
        height: 100%
    }

    .hidden {
        display: none;
    }
</style>
@section('content')
<div class="col py-3 main-panel">
    <div class="BoxChat" style="display: flex;justify-content: center;align-items: center;">
        <div class="row" style="width:100%;">
            <div class="col-12">
                <div class="card" id="chat3" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row">
                            <!-- User -->
                            <div class="col-4" >
                                <div class="p-3">
                                    <div class="input-group rounded mb-3">
                                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                                        aria-describedby="search-addon" />
                                    <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    </div>
        
                                    <div style="position: relative; height: 610px%; overflow: auto;">
                                        <?php 
                                            $users =  DB::select("SELECT A.*, B.AmountMessegeToUserUnseen 
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
                                                    Order By A.CreateAt DESC", 
                                                    [
                                                        "id1" => session('my_user_id'),
                                                        "id2" => session('my_user_id'),
                                                    ]);
                                            foreach ($users as $user) {                                                 
                                            
                                        ?>
                                            <button type="button" name="ButtonUserChat-{{$user->FromUserId}}" class="d-flex justify-content-between" 
                                                style="border: none;background: none;background-color: white; width: 100%">
                                                <div  name="user_id" style="display: none">{{$user->FromUserId}}</div>
                                                <div class="d-flex flex-row">
                                                    <div>
                                                        <img
                                                        src="{{ $user->ava_img_path == null ? asset('images/AvatarImage/defaultAvatarProfile.jpg') : asset('images/AvatarImage/'.$user->ava_img_path) }}"
                                                        alt="avatar" class="d-flex align-self-center me-3" width="60">
                                                        <span class="badge bg-success badge-dot"></span>
                                                    </div>
                                                    <div class="pt-1">
                                                        <p class="fw-bold mb-0">{{$user->Name}}</p>
                                                        <p class="small text-muted" id="TextNewInUser-{{$user->FromUserId}}">{{$user->Body}}</p>
                                                    </div>
                                                    </div>
                                                    <div class="pt-1">
                                                    <p class="small text-muted mb-1" id="CreateAt-{{$user->FromUserId}}">{{$user->CreateAt}}</p>                                                                   
                                                    <p id="AmountMessegeToUserUnseen-{{$user->FromUserId}}"     
                                                        @if($user->AmountMessegeToUserUnseen != null) 
                                                            class="badge bg-danger rounded-pill float-end"
                                                        @endif >
                                                            {{$user->AmountMessegeToUserUnseen}}
                                                    </p>                                                                         
                                                </div>
                                            </button>
                                            <hr>
                                        <?php } ?>
                                    </div>
                                </div>                           
                            </div>
                            <!-- End User -->
                            <!-- chat -->
                            <div class="col-8">
                                <div class="pt-3 pe-3" id="contentMessage"
                                    style="position: relative; height: 610px; overflow: auto;">
                                    <div id="ItemMessage">

                                    </div>
                                </div>
                                <div id="HiddenBox" class="hidden">
                                    <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                                        <input type="text" class="form-control form-control-lg" id="BodyMessage"
                                            placeholder="Type message">
                                        <button type="button" id="ButtonSendMessage" style="border: none;background: none;margin-left: 5px;">
                                            <i class="fas fa-paper-plane" style="color: gray"></i>
                                        </button>
                                    </div>     
                                </div>                           
                            </div>
                            <!-- End chat -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="shop-id" style="display: none;" value={{Session::get('my_user_id')}}>{{ Session::get('my_user_id') }}</div>
</div>
<script>
   
    var ButtonSendMessage = document.querySelector('#ButtonSendMessage');  
    var shopId = document.querySelector('#shop-id').textContent;
    var ButtonsUserChat = document.querySelectorAll('button[name^="ButtonUserChat-"]');
    var UserChoiceId = 0;
    var TextBodyUserElement = null;
    var myInterval = null;
    var lastId = null;

    function GetMessage() {
        //console.log("GetMessage work");
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);    
                    var Messages = response.messages;               
                    Messages.forEach((message) => {      
                        lastId = message.Id;                      
                        if(message.FromUserId == shopId) {
                            var newItem = document.createElement('div');
                            newItem.classList.add('d-flex');
                            newItem.classList.add('flex-row');
                            newItem.classList.add('justify-content-end');
                            newItem.innerHTML = `
                                <div>
                                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                        ${message.Body}
                                    </p>
                                    <p class="small me-3 mb-3 rounded-3 text-muted">${message.CreateAt}</p>
                                </div>
                                <img src="{{  asset('images/AvatarImage/${message.ava_img_path}') }}"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                            `;
                            var BoxComment = document.querySelector('#ItemMessage');
                            BoxComment.appendChild(newItem);
                        }
                        else {                          
                            var newItem = document.createElement('div');
                            newItem.classList.add('d-flex');
                            newItem.classList.add('flex-row');
                            newItem.classList.add('justify-content-start');
                            newItem.innerHTML = `
                                <img src="{{  asset('images/AvatarImage/${message.ava_img_path}') }}"
                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                <div>
                                    <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
                                        ${message.Body}
                                    </p>
                                    <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${message.CreateAt}</p>
                                </div>
                            `;
                            TextBodyUserElement.textContent = message.Body;
                            var BoxComment = document.querySelector('#ItemMessage');
                            BoxComment.appendChild(newItem);
                        }
                    });
                    if(Messages.length > 0) {
                        var content = document.getElementById("contentMessage");
                        content.scrollTop = content.scrollHeight;
                    }                    
                } 
                else {
                    // Xử lý logic khi lỗi             
                }
            }
        };
        xhr.open('POST', '/GetMessage');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            lastId: lastId,
            FromUserId: UserChoiceId,
            ToUserId: shopId
        };
        xhr.send(JSON.stringify(data));
        updateSeen(UserChoiceId, shopId);
    }

    function UpdateBoxChat() {
        //console.log("UpdateBoxChat work");
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {                                  
                    var response = JSON.parse(xhr.response);
                    var BoxChats = response.usersBoxChat;
                    BoxChats.forEach((user) => {
                        var ButtonsUserChat_Update = document.querySelector(`button[name="ButtonUserChat-${user.FromUserId}"]`);
                        ButtonsUserChat_Update.querySelector(`#TextNewInUser-${user.FromUserId}`).innerText = user.Body;                  
                        ButtonsUserChat_Update.querySelector(`#CreateAt-${user.FromUserId}`).innerText = user.CreateAt;
                        
                        var AmountUnseenElement = ButtonsUserChat_Update.querySelector(`#AmountMessegeToUserUnseen-${user.FromUserId}`);
                        if (!AmountUnseenElement.classList.contains('badge')) {
                            AmountUnseenElement.classList.add('badge');
                        }
                        if (!AmountUnseenElement.classList.contains('bg-danger')) {
                            AmountUnseenElement.classList.add('bg-danger');
                        }
                        if (!AmountUnseenElement.classList.contains('rounded-pill')) {
                            AmountUnseenElement.classList.add('rounded-pill');
                        }
                        if (!AmountUnseenElement.classList.contains('float-end')) {
                            AmountUnseenElement.classList.add('float-end');
                        }

                        AmountUnseenElement.innerText = user.AmountMessegeToUserUnseen;

                        clearInterval(intervalUpdateBoxChat_Id);
                        intervalUpdateBoxChat_Id = setInterval(UpdateBoxChat, 1000);
                    });
                    
                } else {
                    // Xử lý logic khi lỗi

                }
            }
        };
        xhr.open('GET', '/ChatSupportUser/GetBoxChat');
        xhr.send();      
    }

    var intervalUpdateBoxChat_Id  = setInterval(function() {UpdateBoxChat()}, 1000);  

    //clearInterval(myInterval);

    function updateSeen(FromUserId, ToUserId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {                                  
                    var response = JSON.parse(xhr.response);
                    var AmountUnseenElement = document.querySelector(`#AmountMessegeToUserUnseen-${FromUserId}`);
                    if (AmountUnseenElement.classList.contains('badge')) {
                        AmountUnseenElement.classList.remove('badge');
                    }
                    if (AmountUnseenElement.classList.contains('bg-danger')) {
                        AmountUnseenElement.classList.remove('bg-danger');
                    }
                    if (AmountUnseenElement.classList.contains('rounded-pill')) {
                        AmountUnseenElement.classList.remove('rounded-pill');
                    }
                    if (AmountUnseenElement.classList.contains('float-end')) {
                        AmountUnseenElement.classList.remove('float-end');
                    }
                    AmountUnseenElement.innerText = "";
                    console.log(response);
                } else {
                    // Xử lý logic khi lỗi

                }
            }
        };
        xhr.open('GET', `/ChatSupportUser/UpdateSeen?FromUserId=${FromUserId}&ToUserId=${ToUserId}`);
        xhr.send();      
    }

    for (var i = 0; i < ButtonsUserChat.length; i++) { 
        var IdUserElement = ButtonsUserChat[i].querySelectorAll('div[name="user_id"]')[0];
        (function(IdUserElement) {
            ButtonsUserChat[i].addEventListener('click', function(e) { 
                var myDiv = document.querySelector('#ItemMessage');
                myDiv.innerHTML = '';
                var myDiv = document.querySelector('#HiddenBox');
                myDiv.classList.remove('hidden');
                var IdUser = IdUserElement.textContent;
                UserChoiceId = IdUser;  
                updateSeen(UserChoiceId, shopId);
                var IdString = "TextNewInUser-" + UserChoiceId
                TextBodyUserElement = document.querySelector('#'+IdString);   
                lastId = 0;          
                clearInterval(myInterval);
                myInterval = setInterval(function() {GetMessage()}, 1000);                        
            });
        })(IdUserElement);
    }

    ButtonSendMessage.addEventListener('click', function(e) {
        var BodyMessage = document.querySelector('#BodyMessage');
        var BodyMessageValue = BodyMessage.value;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);    
                    var imageAvatar = response.imageAvatar;   
                    var FromUserName = response.FromUserName;   
                    var commentDate = response.commentDate;  
                    var commentContent = response.commentContent;  
                    document.querySelector('#BodyMessage').value = '';
                } else {
                    // Xử lý logic khi lỗi
                    
                }
            }
        };
        xhr.open('POST', '/SendMessage');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            FromUserId: shopId,
            ToUserId: UserChoiceId,
            BodyMessageValue: BodyMessageValue,
            CreateAt: moment(Date.now()).utcOffset(7).format('YYYY-MM-DD HH:mm:ss')
        };
        xhr.send(JSON.stringify(data));
    });
</script>
@endsection