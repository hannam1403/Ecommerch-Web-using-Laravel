<style>
    .ChatBox {
        position: fixed;
        bottom: 75px;
        right: 50px;
        width: 350px;
        height: 450px;
        z-index: 9999; 
        border-radius: 5px;
    }

    .hidden {
        display: none;
    }
</style>
<div class="ChatBox hidden">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-3" >     
            <h5 class="mb-0">Chat messages</h5>
            <div class="d-flex flex-row align-items-center">
                <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                <button type="button" onclick="hideChatBox()" style="height: 25px;border: none;background: none;"><i class="fas fa-times text-muted fa-xs"></i></button>
            </div>
        </div>

        <div class="card-body" id="contentMessage" style="position: relative; height: 400px; overflow: auto;">
   
        </div>

        <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
            <div class="input-group mb-0">
              <input type="text" class="form-control" placeholder="Nhập tin nhắn ..."
                aria-label="Recipient's username" aria-describedby="ButtonSendMessage" id="BodyMessage"/>
              <button class="btn btn-warning" type="button" id="ButtonSendMessage" style="padding-top: .55rem;">
                Gửi
              </button>
            </div>
        </div>
    </div>
</div>
<script>
    var myInterval = null;
    var lastId = null;

    function hideChatBox() {
        var chatBox = document.querySelector('.ChatBox');
        chatBox.classList.add('hidden');
        var myDiv = document.querySelector('#contentMessage');
        myDiv.innerHTML = '';
        clearInterval(myInterval);
    }

    var ButtonSendMessage = document.querySelector('#ButtonSendMessage');  
    var userId = document.querySelector('#user-id').textContent;
    var shopId = document.querySelector('#shop-id').textContent;
    
    
    function GetMessage() {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);                             
                    var Messages = response.messages;
                    if(Messages.length > 0) {
                        var content = document.getElementById("contentMessage");
                        content.scrollTop = content.scrollHeight;
                    }
                    Messages.forEach((message) => {    
                        lastId = message.Id;                                                
                        if(message.FromUserId == userId) {
                            var newItem = document.createElement('div');
                            newItem.setAttribute('name', 'ItemMessage');
                            newItem.innerHTML = `
                                <div class="d-flex justify-content-between">
                                    <p class="small mb-1 text-muted">${message.CreateAt}</p>
                                    <p class="small mb-1">${message.Name}</p>
                                </div>
                                <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                    <div>
                                    <p class="small p-2 me-3 mb-3 text-white rounded-3 bg-warning">
                                        ${message.Body}
                                    </p>
                                    </div>
                                    <img src="{{  asset('images/AvatarImage/${message.ava_img_path}') }}"
                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                </div>
                            `;
                            var BoxComment = document.querySelector('.card-body');
                            BoxComment.appendChild(newItem);
                        }
                        else {
                            var newItem = document.createElement('div');
                            newItem.setAttribute('name', 'ItemMessage');
                            newItem.innerHTML = `
                            <div class="d-flex justify-content-between">
                                <p class="small mb-1">${message.Name}</p>
                                <p class="small mb-1 text-muted">${message.CreateAt}</p>
                            </div>
                            <div class="d-flex flex-row justify-content-start">
                                <img src="{{ asset('images/AvatarImage/${message.ava_img_path}') }}"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                                <div>
                                    <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">
                                        ${message.Body}
                                    </p>
                                </div>
                            </div>
                            `;
                            var BoxComment = document.querySelector('.card-body');
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
        console.log("hello");
        xhr.open('POST', '/GetMessage');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            lastId: lastId,
            FromUserId: userId,
            ToUserId: shopId
        };
        xhr.send(JSON.stringify(data));
    }

    

    ButtonSendMessage.addEventListener("click", function() { 
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
            FromUserId: userId,
            ToUserId: shopId,
            BodyMessageValue: BodyMessageValue,
            CreateAt: moment(Date.now()).utcOffset(7).format('YYYY-MM-DD HH:mm:ss')
        };
        xhr.send(JSON.stringify(data));
    });
</script>

    