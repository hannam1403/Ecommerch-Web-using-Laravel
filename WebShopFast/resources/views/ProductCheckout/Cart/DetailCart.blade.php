@extends('ProductCheckout.Layouts.Main')
@section('content')
    <div class="container" >
        <div class="row" style="background-color: RGB(245, 245, 245);">
            <div class="col-12">
                <h1 style="margin: 10px;font-size: 38px;">Giỏ Hàng</h1>
            </div>
        </div>
        <div class="row" style="margin-top: 25px; text-align: center; padding: 10px; background-color: RGB(245, 245, 245);"> 
            <div class="col">
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
            <div class="col-2">
                Thao tác
            </div>
        </div>
        
        <!-- Sản phẩm -->
        @foreach ($carts as $cart)
        <div class="row" name="BoxProduct" style="margin-top: 25px; text-align: center; padding: 5px; margin-bottom: 25px; background-color: RGB(245, 245, 245);">
            <div class="col-4">
                <div class="row">
                    <h5 hidden name="CartDetailId">{{ $cart->CartDetailId }}</h5>
                    <h5 hidden name="ProductId">{{ $cart->ProductId }}</h5>
                    <div class="col-3" style="padding: 0;">
                        <img src="{{ asset('images/Product/'.$cart->Pic) }}" alt="" style="width: 100%; height: 100px;">
                    </div>
                    <div class="col">
                        {{ $cart->Name }}
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div name="PriceProduct">{{ $cart->Price }}</div>
            </div>
            <div class="col-2">
                <div style="display: flex; justify-content:center; height: 35px;"> 
                    <button name="MinusButton" class="btn btn-outline-dark me-2 btn-sm decrease-quantity">-</button> 
                    <span class="quantity" name="Quantity">{{ $cart->Quantity }}</span>
                    <button name="PlusButton" class="btn btn-outline-dark ms-2 btn-sm increase-quantity">+</button>
                </div>
            </div>
            <div class="col-2">
               <span name="PriceAmount">{{ $cart->Price * $cart->Quantity }}</span> 
            </div>
            <div class="col-2">           
                <a href="DetailCart/DeleteCartProduct/{{ $cart->CartDetailId }}">
                    <button type="button" class="btn btn-danger">Xóa</button>
                </a>
            </div>
        </div>
        @endforeach
        <!-- End Sản phẩm -->

        <!-- Tổng tiền -->
        <div class="row" style="margin-top: 25px; text-align: center; padding: 10px; margin-bottom: 25px; background-color: RGB(245, 245, 245);">
            <div class="col-10" style="text-align: right;">
                Tổng thanh toán ({{ $totalProduct }} sản phẩm): <span name="TotalPrice"> {{ $totalPrices }} </span>
            </div>
            <div class="col-2">
                <a href="/Checkout">
                    <button type="button" class="btn btn-primary" >Mua Hàng</button>
                </a>
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

        var products = document.querySelectorAll('div[name="BoxProduct"]');
        var TotalPrice = document.querySelector('span[name="TotalPrice"]');
       
        for (var i = 0; i < products.length; i++) {
            var CartDetailIdElement = products[i].querySelectorAll('h5[name="CartDetailId"]')[0];
            var ProductIdElement = products[i].querySelectorAll('h5[name="ProductId"]')[0];
            var PriceAmount = products[i].querySelectorAll('span[name="PriceAmount"]')[0];
            var MinusQuantityElement = products[i].querySelectorAll('button[name="MinusButton"]')[0];
            var PlusQuantityElement = products[i].querySelectorAll('button[name="PlusButton"]')[0];
            var QuantityElement = products[i].querySelectorAll('span[name="Quantity"]')[0];
            var productId = ProductIdElement.textContent;
            var CartDetailId = CartDetailIdElement.textContent;
            var quantity = parseInt(QuantityElement.textContent);

            (function(QuantityElement, CartDetailId, quantity, PriceAmount) {             
                MinusQuantityElement.addEventListener('click', function(e) { 
                    if (quantity > 0) {
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                if (xhr.status === 200) {                                  
                                    var response = JSON.parse(xhr.response);
                                    QuantityElement.textContent = response.quantity;  
                                    var price = parseInt(response.PriceProductAmount); 
                                    price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                                    PriceAmount.textContent =  price;  

                                    var price2 = parseInt(response.totalPrices); 
                                    price2 = price2.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                                    TotalPrice.textContent =  price2;         
                                } else {
                                    // Xử lý logic khi lỗi

                                }
                            }
                        };
                        xhr.open('GET', '/cart/decrease-quantity/' + CartDetailId);
                        xhr.send();                           
                    }
                }); 
                PlusQuantityElement.addEventListener('click', function(e) { 
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {        
                            var response = JSON.parse(xhr.response);
                            QuantityElement.textContent = response.quantity; 

                            var price = parseInt(response.PriceProductAmount); 
                            price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                            PriceAmount.textContent =  price;  

                            var price2 = parseInt(response.totalPrices); 
                            price2 = price2.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                            TotalPrice.textContent =  price2;                             
                        } else {
                            // Xử lý logic khi lỗi

                        }
                    }
                    };
                    xhr.open('GET', '/cart/increase-quantity/' + CartDetailId);
                    xhr.send();
                }); 
            })(QuantityElement, CartDetailId, quantity, PriceAmount);
        };
    </script>
@endsection