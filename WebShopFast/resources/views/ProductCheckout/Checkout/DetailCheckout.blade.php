@extends('ProductCheckout.Layouts.Main')
@section('content')
    <div class="container" >
        <div class="row" style="background-color: RGB(245, 245, 245);">
            <div class="col-12">
                <h1 style="margin: 10px;font-size: 38px;">Thanh Toán</h1>
            </div>
        </div>

        <div class="row" style="margin-top: 25px; text-align: left; padding: 10px; background-color: RGB(245, 245, 245);">
            <div class="row">
                <div class="col-12">
                   <h5> Địa Chỉ Nhận Hàng </h5>
                </div>
                <div class="col-12">               
                    <div class="row">
                        <div class="col-10">
                            <?php 
                                $user_id = Session::get('my_user_id');
                                // $user = DB::select('select * from member where Id = :user_id', 
                                // [
                                //     "user_id" => $user_id
                                // ]);

                                $user = DB::table('member')
                                            ->where('Id', $user_id)
                                            ->first();
                                // $address = DB::select('SELECT cart.*, address.Name as AddressName FROM cart JOIN address on cart.AddressId = address.ID WHERE cart.member_id = :user_id and cart.Status = 0 and address.Status=1;', 
                                // [
                                //     "user_id" => $user_id
                                // ]);
                                $addresses = DB::table('address')
                                            ->select('address.Name as AddressName', 'member.Name as CusName', 'member.Phone as Phone')
                                            ->join('cart', 'address.MemberId', '=', 'cart.member_id')
                                            ->join('member', 'cart.member_id', '=', 'member.Id')
                                            ->where('cart.member_id', $user_id)
                                            ->where('cart.Status', '=', 0)
                                            ->where('address.Status', '=', 1)
                                            ->get();
                                foreach ($addresses as $address) {
                            ?>
                            <span style="font-weight: bold;">{{$address->CusName}} {{$address->Phone}}</span> <span id="AddressNameCart">{{$address->AddressName}}</span>
                            <?php 
                                }
                            ?>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalChoiceAddress">Thay đổi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 25px; text-align: center; padding: 10px; background-color: RGB(245, 245, 245);">
            <div class="col-6">
                Giỏ Hàng
            </div>
            <div class="col-2">
                Đơn giá
            </div>
            <div class="col-2">
                Số lượng
            </div>
            <div class="col-2">
                Số tiền
            </div>
        </div>
        
        <!-- Sản phẩm -->
        <!-- Sản phẩm -->
        @foreach ($carts as $cart)
        <div class="row" style="margin-top: 25px; text-align: center; padding: 5px; margin-bottom: 25px; background-color: RGB(245, 245, 245);">
            <div class="col-6">
                <div class="row">
                    <div class="col-3" style="padding: 0;">
                        <img src="{{ asset('images/Product/'.$cart->Pic) }}" alt="" style="width: 100%; height: 100px;">
                    </div>
                    <div class="col-9">
                        {{ $cart->Name }}
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div name="PriceProduct">{{ $cart->Price }}</div>
            </div>
            <div class="col-2">
                <span name="Quantity">{{ $cart->Quantity }}</span>
            </div>
            <div class="col-2">
                <span name="PriceAmount">{{ $cart->Price * $cart->Quantity }}</span> 
            </div>
        </div>
        @endforeach
        <!-- End Sản phẩm -->

        <div class="row" style="margin-top: 25px; text-align: center; padding: 10px; margin-bottom: 25px; background-color: RGB(245, 245, 245);">
            <div class="col-8" style="text-align: left;">
                Phương thức thanh toán
            </div>
            <?php 
                $user_id = Session::get('my_user_id');
                $cart = DB::select("select * from cart where status = 0 and member_id = :user_id",
                [
                    "user_id" => $user_id 
                ]);
                $Payment = DB::select("select paymentMethod.ID, paymentMethod.Name from cart 
                        join paymentMethod
                        on cart.PaymentMethodId = paymentMethod.Id 
                        where cart.Id = :CartId", 
                        [
                            "CartId" => $cart[0]->Id
                        ]);              
            ?>
            <div class="col-2">
               <span id="PaymentMethodName">{{$Payment[0]->Name}}</span> 
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChangePaymentMethodModal">thay đổi</button>
            </div>
        </div>

        <!-- Tổng tiền -->
        <div class="row" style="margin-top: 25px; text-align: center; padding: 10px; margin-bottom: 25px; background-color: RGB(245, 245, 245);">
            <div class="col-10" style="text-align: right;">
                Tổng thanh toán ({{ $totalProduct }} sản phẩm): <span name="TotalPrice"> {{ $totalPrices }} </span> 
            </div>
            <div class="col-2">
                    <button type="button" id="buy-button" class="btn btn-primary">Mua Hàng</button>
            </div>
        </div>
        <!-- End Tổng tiền -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var productsPrice = document.querySelectorAll('div[name="PriceProduct"]');
        for(var i = 0; i < productsPrice.length; i++) {
            var price = parseInt(productsPrice[i].innerText); 
            price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
            productsPrice[i].innerText = price;
        }

        var PriceAmountElement = document.querySelectorAll('span[name="PriceAmount"]');
        for(var i = 0; i < PriceAmountElement.length; i++) {
            var price = parseInt(PriceAmountElement[i].innerText); 
            price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
            PriceAmountElement[i].innerText = price;
        }

        var TotalPrice = document.querySelector('span[name="TotalPrice"]');
        var price = parseInt(TotalPrice.innerText); 
        price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        TotalPrice.innerText = price;

        $(document).ready(function() {
        $('#buy-button').click(function() {
            console.log('Sending AJAX request...'); // Debug code to print a message to the console
            $.ajax({
                url: '{{ route("checkout") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'buy': true
                },
                success: function(response) {
                    console.log('Received AJAX response:', response); // Debug code to print the response to the console
                    if (response.success) {
                        alert('Your order has been placed.');
                        window.location.href = '{{ route("MainWeb") }}';
                    }
                    else {
                        console.log('Error:', response.message); // Debug code to print the error message to the console
                        alert(response.message); // Display the error message
                    }
                },
                error: function() {
                    console.log('An error occurred.'); // Debug code to print a message to the console
                    alert('An error occurred.');
                }
            });
        });
    });
    </script>

    @include('ProductCheckout.Checkout.AddressManager')
    @include('ProductCheckout.Checkout.PaymentMethod')
@endsection