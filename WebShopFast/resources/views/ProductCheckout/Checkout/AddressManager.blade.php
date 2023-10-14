<!-- Modal -->
<div class="modal fade" id="modalChoiceAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Địa chỉ của tôi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="user-id" style="display: none;">{{ Session::get('my_user_id') }}</div>
                <?php 
                    $user_id = Session::get('my_user_id');
                    $users = DB::select('Call GetAccountAddress(:user_id)', 
                    [
                        "user_id" => $user_id
                    ]);                     
                ?>
                <div class="BoxAddress">
                    @foreach ($users as $user)
                    <div class="row" name="ItemAddress">
                        <div class="col-12">
                            <div class="form-check">              
                                <input class="form-check-input" type="radio" name="RadioAddressUser" id="{{$user->AddressId}}" value="{{$user->AddressId}}" @if($user->Status == 1) checked  @endif>
                                <label class="form-check-label" for="{{$user->AddressId}}" style="width: 100%;">
                                    <div class="row">
                                        <div class="col-10">
                                            <span name="name">{{$user->Name}} </span>| <span name="phone"> {{$user->Phone}} </span> @if ($user->Status == 1) <span style="color: red"> Mặc định</span> @endif
                                            <p name="Address">{{$user->AddressName}}  </p>                              
                                        </div>
                                        <div class="col-2" style="text-align: left">
                                            <button type="button" name="btnUpdate" class="btn btn-primary"  data-bs-target="#exampleUpdateAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Cập nhật</button>
                                        </div>
                                    </div>
                                </label>                     
                            </div>
                        </div>
                    </div>                
                    @endforeach 
                </div>                                     
                <button type="button" class="btn btn-primary" data-bs-target="#exampleAddAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Thêm mới địa chỉ</button>                                      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ButtonSaveAddressCart"  data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div> 
<!-- Button trigger modal --> 

  
<div class="modal fade" id="exampleUpdateAddress" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật địa chỉ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="addressInput" class="form-label">Địa chỉ cụ thể</label>
                <input type="text" class="form-control" id="addressInputUpdate">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-target="#modalChoiceAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Trở về</button>
          <button class="btn btn-primary" id="ButtonSaveUpdateAddress" data-bs-target="#modalChoiceAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Hoàn thành</button>
        </div>
      </div>
    </div>
</div>
          
<div class="modal fade" id="exampleAddAddress" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm mới địa chỉ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="addressInput" class="form-label">Địa chỉ cụ thể</label>
                <input type="text" class="form-control" id="AddAddressInput">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-target="#modalChoiceAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Trở về</button>
          <button class="btn btn-primary" id="ButtonSaveAddAddress"  data-bs-target="#modalChoiceAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Hoàn thành</button>
        </div>
      </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
   
    var ButtonSaveAddAddress = document.querySelector('#ButtonSaveAddAddress');
    var ButtonSaveUpdateAddress = document.querySelector('#ButtonSaveUpdateAddress');
    var userId = document.querySelector('#user-id').textContent;
    var IdAddressUpdate = null;

    function SetUpdateButtonEvent() {
        var formChecks = document.querySelectorAll('.form-check');
        for (var i = 0; i < formChecks.length; i++) {
            var IdAddressElement = formChecks[i].querySelectorAll('input[name="RadioAddressUser"]')[0];
            var addressElement = formChecks[i].querySelectorAll('p[name="Address"]')[0];
            var buttonUpdate = formChecks[i].querySelectorAll('button[name="btnUpdate"]')[0];
            var address = addressElement.textContent;

            (function(address, IdAddressElement) {
                buttonUpdate.addEventListener("click", function() {
                    IdAddressUpdate = IdAddressElement.value;
                    document.getElementById("addressInputUpdate").value = address;
                });
            })(address, IdAddressElement);
        }
    }   
    SetUpdateButtonEvent();

    function UpdateIFAddress(addressId, address) {
        var formChecks = document.querySelectorAll('.form-check');
        for (var i = 0; i < formChecks.length; i++) {
            var IdAddressElement = formChecks[i].querySelectorAll('input[name="RadioAddressUser"]')[0];
            var addressElement = formChecks[i].querySelectorAll('p[name="Address"]')[0];
            
            if(IdAddressElement != undefined ) {
                (function(addressElement, IdAddressElement) {
                    if(IdAddressElement.value == addressId) {
                        addressElement.textContent = address;
                    }
                })(addressElement, IdAddressElement);
            }   
        }
    }

    ButtonSaveUpdateAddress.addEventListener("click", function() {    
        var textAddressElement = document.querySelector('#addressInputUpdate');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);  
                    UpdateIFAddress(response.addressId, response.newAddress);
                } else {
                    // Xử lý logic khi lỗi
                }
            }
        };
        xhr.open('POST', '/UpdateNewAddress');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            userId: userId,
            AddressId: IdAddressUpdate,
            newAddress: textAddressElement.value
        };
        xhr.send(JSON.stringify(data));
    });

    ButtonSaveAddAddress.addEventListener("click", function() {      
        var AddAddressInputElement = document.querySelector('#AddAddressInput');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);                               
                    var username = response.UserName;
                    var phone = response.Phone;
                    var newAddress = response.newAddress;
                    var newItem = document.createElement('div');
                    newItem.classList.add('row');
                    newItem.setAttribute('name', 'ItemAddress');
                    newItem.innerHTML = `
                        <div class="col-12">
                        <div class="form-check">                
                            <input class="form-check-input" type="radio" name="exampleRadios" id="newAddress" value="newAddress">
                            <label class="form-check-label" for="newAddress" style="width: 100%;">
                            <div class="row">
                                <div class="col-10">
                                <span name="name">${username} </span>| <span name="phone"> ${phone} </span>
                                <p name="Address">${newAddress}</p>                              
                                </div>
                                <div class="col-2" style="text-align: left">
                                <button type="button" name="btnUpdate" class="btn btn-primary" data-bs-target="#exampleUpdateAddress" data-bs-toggle="modal" data-bs-dismiss="modal">Cập nhật</button>
                                </div>
                            </div>
                            </label>                     
                        </div>
                        </div>
                    `;

                    var addressList = document.querySelector('.BoxAddress');
                    addressList.appendChild(newItem);
                    SetUpdateButtonEvent();
                } else {
                    // Xử lý logic khi lỗi

                }
            }
        };
        xhr.open('POST', '/AddNewAddress');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            userId: userId,
            newAddress: AddAddressInputElement.value
        };
        xhr.send(JSON.stringify(data));
    });

    var ButtonSaveAddressCart = document.querySelector('#ButtonSaveAddressCart');   
    ButtonSaveAddressCart.addEventListener("click", function() { 
        var AddressID = document.querySelector('input[name="RadioAddressUser"]:checked').value;
        var addressElement = document.querySelector('#AddressNameCart');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);                               
                    var AddressName = response.AddressName;
                    addressElement.textContent = AddressName;
                } else {
                    // Xử lý logic khi lỗi

                }
            }
        };
        xhr.open('POST', '/ChangeAddressCart');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            userId: userId,
            AddressID: AddressID
        };
        xhr.send(JSON.stringify(data));
    });
</script>