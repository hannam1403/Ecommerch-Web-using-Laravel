<link rel="icon" href="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" type="image/x-icon"/>

@extends('layouts.app')

@section('content')
    {{-- @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(session('success'))  
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}
    <div class="container text-center pb-4" style="margin-top: 25px;">
        <div class="row" style="margin-top: 2px; height: 100%">
            <div class="col-12"  style="height: 100%">
                <div class="row" style="height: 100px">
                    <div class="col" style="text-align: left">
                       <h1> Hồ Sơ Của Tôi </h1>
                        Quản lý thông tin hồ sơ để bảo mật tài khoản
                    </div>                   
                </div>
                <div class="row" style="height: 100%"> 
                    <div class="col-8" style="text-align: left">
                        <!-- Information of user -->
                        <form action="/detailAccount/{{ Session::get('my_user_id')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputUsername" name="Username" value="{{$user->username}}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="Name" value="{{$user->name}}">
                                </div>
                            </div> 
                            <div class="mb-3 row">
                                <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputAddress" name="Address" value="{{$user->address}}" readonly>
                                </div>
                            </div>  
                            <div class="mb-3 row">
                                <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPhone"  name="Phone" value="{{$user->phone}}">
                                </div>
                            </div>    
                            <div class="mb-3 row">
                                <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="Gender" id="inputGender">
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>                            
                            </div>
                            <div class="mb-3 row">
                                <label for="inputBirthday" class="col-sm-2 col-form-label">Birthday</label>
                                <div class="col-sm-10">
                                    <input type="date" id="form2Example11" class="form-control" name="Birthday" value="{{$user->birthday}}" id="inputBirthday"/>                           
                                </div>
                            </div>    
                            <div class="mb-3 row">
                                <label for="formFile" class="col-sm-2 col-form-label">Avatar</label>
                                <div class="col-sm-10">
                                    <input  type="file" class="form-control" id="formFile" name="ImageAvatar">                        
                                </div>
                            </div>   
                            <div class="mb-3 row">
                                <div class="col"  style="text-align: end;">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>    
                        </form>                      
                         <!-- End Information of user -->                      
                    </div>                   
                    <div class="col-4" >
                        <!-- Upload avatar -->
                        <img src="{{ $user->ava_img_path == null ? asset('images/AvatarImage/defaultAvatarProfile.jpg') : asset('images/AvatarImage/'.$user->ava_img_path) }}" class="rounded-circle" 
                                style="width: 250px; height: 250px;"
                                alt="Avatar" />
                        <h5 class="mb-2"><strong>{{$user->name}}</strong></h5>
                        <p class="text-muted" >Số dư ví: <span id="AmountVNP"> {{$user->AccountBalance}}</span> </p>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <div class="row">
                                <button class="btn btn-primary" name="redirect" style="width: 100%;"  data-bs-toggle="modal" data-bs-target="#VnpayPaymentModal" >Nạp tiền</button>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary" name="redirect" style="width: 100%;"  data-bs-toggle="modal" data-bs-target="#Withdraw" >Rút tiền</button>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary" type="button" >
                                    <a href="/change-password/{{ Session::get('my_user_id')}}" style="color:aliceblue; text-decoration: none;">
                                        Đổi mật khẩu
                                    </a>
                                </button>
                            </div>              
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
  </div>
<script>
    var AmountVNP = document.querySelector('#AmountVNP');
    var price = parseInt(AmountVNP.innerText); 
    price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    AmountVNP.innerText = price;
</script>
@endsection

<div class="modal fade" id="VnpayPaymentModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="/VnpayPayment" method="post" style="padding: 0">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Nạp tiền vào ví ShopFast</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="AmountMoneyInput" class="form-label">Số tiền</label>
                    <input type="text" class="form-control" id="AmountMoneyInput" name="AmountMoney">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở về</button>
                <button type="submit" class="btn btn-primary" name="redirect"  data-bs-dismiss="modal">Hoàn thành</button>                 
            </div>
        </form>  
      </div>
    </div>
</div>

<div class="modal fade" id="Withdraw" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="/detailAccount/withdraw" method="post" style="padding: 0">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel1">Rút tiền khỏi ví</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="AmountMoneyInput" class="form-label">Số tiền muốn rút: </label>
                    <input type="text" class="form-control" id="AmountMoneyInput" name="AmountMoneyWithdraw">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở về</button>
                <button type="submit" class="btn btn-primary" name="redirect"  data-bs-dismiss="modal">Hoàn thành</button>                 
            </div>
        </form>  
      </div>
    </div>
</div>
