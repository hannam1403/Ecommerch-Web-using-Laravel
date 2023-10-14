@extends('layouts.app')
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: left;
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }
    /* ratingAVG */
    .ratingAVG {
        display: flex;
        flex-direction: row-reverse;
        justify-content: left;
    }

    .ratingAVG>input {
        display: none
    }

    .ratingAVG>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer
    }

    .ratingAVG>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .ratingAVG>label:hover:before,
    .ratingAVG>label:hover~label:before {
        opacity: 1 !important
    }

    .ratingAVG>input:checked~label:before {
        opacity: 1
    }
</style>
@section('content')
<div class="container text-center" >
     <!-- Thong tin san pham -->
    <div class="row align-items-stretch" style="height: 450px; padding-bottom: 20px; padding-top: 30px; background-color: rgba(0, 0, 0, 0.05);">
        <div class="col-4">        
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="margin-left: 10px;">
                <div class="carousel-inner">               
                    @foreach($product->getImages() as $key => $image)
                        <div class="carousel-item @if($key == 0) active @endif">
                            <img src="{{ asset('images/Product/'.$image->getImgProductPath()) }}" class="d-block w-100"  
                                style="width: 350px; height: 400px;" id="KeyImage-{{$key}}"
                                alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-8" >           
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <h4 style="text-align: left; ">{{$product->getName()}}</h4>
                </div>    
            </div>      
            <div class="mb-3 row">
                <div class="col-sm-5">
                    <div class="ratingAVG"> 
                        @if($numberRatingAvg != null)
                            <input type="radio" name="ratingAVG" value="5" id="5" disabled @if($numberRatingAvg ==5) checked @endif><label disabled for="5">☆</label> 
                            <input type="radio" name="ratingAVG" value="4" id="4" disabled @if($numberRatingAvg ==4) checked @endif><label disabled for="4">☆</label> 
                            <input type="radio" name="ratingAVG" value="3" id="3" disabled @if($numberRatingAvg ==3) checked @endif><label disabled for="3">☆</label> 
                            <input type="radio" name="ratingAVG" value="2" id="2" disabled @if($numberRatingAvg ==2) checked @endif><label disabled for="2">☆</label> 
                            <input type="radio" name="ratingAVG" value="1" id="1" disabled @if($numberRatingAvg ==1) checked @endif><label disabled for="1">☆</label>
                        @else 
                            <input type="radio" name="ratingAVG" value="5" id="5" disabled ><label disabled for="5">☆</label> 
                            <input type="radio" name="ratingAVG" value="4" id="4" disabled ><label disabled for="4">☆</label> 
                            <input type="radio" name="ratingAVG" value="3" id="3" disabled ><label disabled for="3">☆</label> 
                            <input type="radio" name="ratingAVG" value="2" id="2" disabled ><label disabled for="2">☆</label> 
                            <input type="radio" name="ratingAVG" value="1" id="1" disabled ><label disabled for="1">☆</label>
                        @endif
                    </div>
                </div>
            </div>      
            <div class="mb-3 row">
                <label for="inputQuantityReview" class="col-sm-2 col-form-label" style="text-align: left;">Amount Review</label>
                <div class="col-sm-5">
                    <span class="review-no" id="inputCount" >{{ $COUNT}} </span>
                </div>
            </div>     
            <div class="mb-3 row">
                <label for="inputPrice" class="col-sm-2 col-form-label" style="text-align: left;">Price</label>
                <div class="col-sm-5">
                    <div class="form-control-plaintext" id="inputPrice">{{$product->getPrice()}}</div>
                </div>
            </div>     
            <div class="mb-3 row">
                <label for="inputQuantity" class="col-sm-2 col-form-label" style="text-align: left;">Quantity</label>
                <div class="col-sm-5">
                    <div class="form-control-plaintext" id="inputQuantity">{{$product->getQuantityInStock()}}</div>
                </div>
            </div>
            <div class="mb-3 row" style="margin-top: 50px;">
                @if($product->getQuantityInStock() == 0)
                    <div class="col-sm-3" style="color:  red">
                        <h4 style="text-align: left; ">Hết hàng</h4>
                    </div> 
                @else
                    <div class="col-sm-3" style="text-align: left;">
                        <button 
                            @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif
                            type="button" class="btn btn-primary" name="AddProduct">
                            <i class="fas fa-cart-plus" ></i> Thêm vào giỏ hàng
                        </button>
                    </div>  
                @endif   
                    <div class="col-sm-3" style="text-align: left;">
                        <button 
                            @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif
                            type="button" class="btn btn-danger" name="BtnReportProduct" data-bs-toggle="modal" data-bs-target="#ModalReportProduct">
                                Báo cáo sản phẩm
                        </button>
                    </div> 
            </div>       
        </div>    
    </div>
    <!-- End Thong tin san pham -->

    <!-- Thong tin cua shop -->
    <div class="row align-items-stretch" style="margin-top: 20px; text-align: left; background-color: rgba(0, 0, 0, 0.05);">
        <div class="col">
            <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="col-4">
                    <img src="{{ $shop->ava_img_path == null ? asset('images/AvatarImage/defaultAvatarProfile.jpg') : asset('images/AvatarImage/'.$shop->ava_img_path) }}" class="rounded-circle" 
                                style="width: 100px; height: 100px;"
                                alt="Avatar" />
                </div>
                <div class="col-8">
                    <div class="row">
                        <strong>{{ $product->NameShop }}</strong>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col">
                            
                            <button 
                                type="button" class="btn btn-outline-danger" 
                                @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif
                                onclick="showChatBox()">
                                <i class="fa-solid fa-comments"></i> Chat ngay
                            </button>
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#InfoDetailShop">
                                <i class="fa-solid fa-shop"></i> Xem shop
                            </button>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            Tổng số lượng Đánh giá: <strong>{{$TongTuongTac}}</strong>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px; ">
                        <div class="col">
                            Tổng số lượng sản phẩm: <strong>{{$TongSanPham}}</strong>
                        </div>                       
                    </div>       
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            Ngày Tham gia: <strong>{{$NgayThamGIa}}</strong>
                        </div>                       
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col">
                            Thời gian phản hổi: <strong>Trong vài giờ</strong>
                        </div>                      
                    </div>       
                </div>
            </div>
        </div>
    </div>
     <!-- End Thong tin cua shop -->

     <!-- Mo ta san pham -->
    <div class="row align-items-stretch" style="margin-top: 20px; padding-bottom: 20px; padding-top: 20px; background-color: rgba(0, 0, 0, 0.05);">
        <div class="col" style="text-align: left;">
            <h4>MÔ TẢ SẢN PHẨM</h4>
            <div  style="text-align: left;">
                {!!$product->getDescription()!!}
            </div>
        </div>
    </div>
     <!-- End Mo ta san pham -->

      <!-- Đánh giá san pham -->
     <div class="row align-items-stretch" style="margin-top: 20px; margin-bottom: 20px; padding-top: 20px; background-color: rgba(0, 0, 0, 0.05);">
        <div class="col" style="text-align: left;">  
            @php 
            $checkData = DB::table('bill')
                            ->join('billdetail', 'bill.id', '=', 'billdetail.IdBill')
                            ->where('bill.IdMember', '=', Session::get('my_user_id'))
                            ->where('billdetail.IdProduct', '=', $product->getId())
                            ->where('billdetail.Status', '=', 4)
                            ->count();                                            
            @endphp          
            <div class="mb-3 row">
                <div class="col">
                    <h4>ĐÁNH GIÁ SẢN PHẨM</h4>
                </div>
                <?php 
                        if($checkData == 0)  {        
                ?>
                <div class="col">
                        <h5 style="color: red;">Bạn phải mua hàng thì mới được đánh giá sản phẩm</h5>
                </div>
                <?php  
                    } 
                ?>
            </div>         
            <!-- rating --> 
            <div class="mb-3 row mt-3" style="text-align: left;">
                <div class="col-2" >
                    <?php 
                        $dataRatingAvg2 = DB::select("SELECT ProductId, AVG(star) As AVG FROM rating WHERE ProductId = :productId GROUP BY ProductId", 
                        [
                            'productId' => $productId
                        ]);
                        if (empty($dataRatingAvg2)) {
                            $numberRatingAvg2 = 0;
                        } 
                        else {
                           
                            $numberRatingAvg2 =  floatval($dataRatingAvg2[0]->AVG);
                        }
                    ?>
                    <?php 
                        if($checkData > 0)  {        
                    ?>
                    <h5>{{$numberRatingAvg2}} trên 5</h5>
                    <div class="rating"> 
                        @if($numberStar != null)
                            <input type="radio" name="ratingRate" value="5" id="5" @if($numberStar ==5) checked @endif><label for="5" name="ratingSubmit" value="5">☆</label> 
                            <input type="radio" name="ratingRate" value="4" id="4" @if($numberStar ==4) checked @endif><label for="4" name="ratingSubmit" value="4">☆</label> 
                            <input type="radio" name="ratingRate" value="3" id="3" @if($numberStar ==3) checked @endif><label for="3" name="ratingSubmit" value="3">☆</label> 
                            <input type="radio" name="ratingRate" value="2" id="2" @if($numberStar ==2) checked @endif><label for="2" name="ratingSubmit" value="2">☆</label>
                            <input type="radio" name="ratingRate" value="1" id="1" @if($numberStar ==1) checked @endif><label for="1" name="ratingSubmit" value="1">☆</label>
                        @else 
                            <input type="radio" name="ratingRate" value="5" id="5" ><label for="5" name="ratingSubmit" value="5">☆</label> 
                            <input type="radio" name="ratingRate" value="4" id="4" ><label for="4" name="ratingSubmit" value="4">☆</label> 
                            <input type="radio" name="ratingRate" value="3" id="3" ><label for="3" name="ratingSubmit" value="3">☆</label> 
                            <input type="radio" name="ratingRate" value="2" id="2"><label for="2" name="ratingSubmit" value="2">☆</label>
                            <input type="radio" name="ratingRate" value="1" id="1" ><label for="1" name="ratingSubmit" value="1">☆</label>
                        @endif
                    </div>
                    <?php  
                        } 
                    ?>
                </div>                          
                <div class="col-10">
                    <?php 
                        $TongRating = DB::select("SELECT count(MemberId) as TongRating FROM rating WHERE productId = :productID", 
                        [
                            'productID' => $productId
                        ]);

                        $SoLuotRating1 = DB::select("SELECT count(MemberId) as SoLuotRating1 FROM rating WHERE productId = :productID and star = 1", 
                        [
                            'productID' => $productId
                        ]);

                        $SoLuotRating2 = DB::select("SELECT count(MemberId) as SoLuotRating2 FROM rating WHERE productId = :productID and star = 2", 
                        [
                            'productID' => $productId
                        ]);

                        $SoLuotRating3 = DB::select("SELECT count(MemberId) as SoLuotRating3 FROM rating WHERE productId = :productID and star = 3", 
                        [
                            'productID' => $productId
                        ]);

                        $SoLuotRating4 = DB::select("SELECT count(MemberId) as SoLuotRating4 FROM rating WHERE productId = :productID and star = 4", 
                        [
                            'productID' => $productId
                        ]);
                        $SoLuotRating5 = DB::select("SELECT count(MemberId) as SoLuotRating5 FROM rating WHERE productId = :productID and star = 5", 
                        [
                            'productID' => $productId
                        ]);
                    ?>
                    <button type="button" class="btn btn-outline-dark me-3">Tất cả ({{$TongRating[0]->TongRating}} lượt)</button>
                    <button type="button" class="btn btn-outline-dark me-3">5 sao ({{$SoLuotRating5[0]->SoLuotRating5}} lượt)</button>
                    <button type="button" class="btn btn-outline-dark me-3">4 sao ({{$SoLuotRating4[0]->SoLuotRating4}} lượt)</button>
                    <button type="button" class="btn btn-outline-dark me-3">3 sao ({{$SoLuotRating3[0]->SoLuotRating3}} lượt)</button>
                    <button type="button" class="btn btn-outline-dark me-3">2 sao ({{$SoLuotRating2[0]->SoLuotRating2}} lượt)</button>
                    <button type="button" class="btn btn-outline-dark me-3">1 sao ({{$SoLuotRating1[0]->SoLuotRating1}} lượt)</button>
                </div>               
            </div>
             <!-- end rating --> 

            <!-- binh luan -->
            <div class="mb-3 row" style="text-align: center;">
                <label for="staticEmail" class="col-sm-1 col-form-label">Bình luận</label>
                <div class="col-sm-10">
                   
                    <textarea class="form-control" @if($checkData == 0) disabled @endif id="commentInputElement" rows="3"></textarea>
                </div>
                <div class="col-sm-1">
                    <button type="button" id="ButtonSubmitComment" @if($checkData == 0) disabled @endif class="btn btn-primary" style="width: 100%">Gửi</button>
                </div>
            </div>

            <div class="BoxComment" id="BoxComment">
                @foreach($product->getComments() as $comment)
                    <div class="mb-3 row" style="text-align: left;">
                        <div id="Comment-id-{{$comment->CommentId}}" data-comment-id="{{$comment->CommentId}}"></div>
                        <div class="col-1" style="text-align: center;">
                            <img src="{{ $comment->ava_img_path == null ? asset('images/AvatarImage/defaultAvatarProfile.jpg') : asset('images/AvatarImage/'.$comment->ava_img_path) }}" class="rounded-circle" 
                                        style="width: 50px; height: 50px;"
                                        alt="Avatar" />
                        </div>
                        <div class="col-8" style="text-align: left; ">
                            <div class="row">
                                <h6 style="margin: 0">{{$comment->Name}}</h6>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{$comment->CreateAt}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    {{$comment->Content}}
                                </div>                       
                            </div>
                        </div>
                        <div class="col-sm-3" style="text-align: right;">
                            <button                 
                                @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif         
                                type="button" class="btn btn-danger" name="BtnReportComment" data-bs-toggle="modal" data-bs-target="#ModalReportComment">
                                    Báo cáo bình luận
                            </button>
                        </div> 
                    </div>
                    <hr>
                @endforeach              
            </div>
            <div id="PaginationComment" class="pagination justify-content-center pt-5">
                {{ $product->getComments()->onEachSide(1)->links() }}
            </div>
             <!-- end binh luan -->
        </div>
     </div>
     <!-- End Đánh giá san pham -->
</div>


<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="user-id" style="display: none;" value="{{ Session::get('my_user_id') }}">{{ Session::get('my_user_id') }}</div>
<div id="product-id" style="display: none;">{{ $product->getId() }}</div>
<div id="shop-id" style="display: none;">{{ $shop->Id }}</div>
@include('Product.chatShop');
@include('Product.InfoShopProduct');
@include('Product.reportProduct');
@include('Product.reportComment');
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    var AddProductElement = document.querySelector('button[name="AddProduct"]');
    AddProductElement.addEventListener("click", function() {
        var productId = document.querySelector('#product-id').textContent;
        var imageUrl = document.querySelector('#KeyImage-0').src;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {                                  
                    var response = JSON.parse(xhr.response);
                    // Xử lý logic khi thành công
                    if(response.isExist == false) {
                        var li = document.createElement('li');
                        li.classList.add('cart-hover-product');

                        var img = document.createElement('img');
                        img.classList.add('cart-hover-img');
                        img.setAttribute('src', imageUrl);
                        li.appendChild(img);

                        var div1 = document.createElement('div');
                        div1.classList.add('cart-hover-product-info');
                        li.appendChild(div1);

                        var div2 = document.createElement('div');
                        div2.classList.add('cart-hover-product-head');
                        div2.classList.add('pe-3');
                        div1.appendChild(div2);

                        var h5 = document.createElement('h5');
                        h5.classList.add('cart-hover-product-name');
                        h5.textContent = name;
                        div2.appendChild(h5);

                        var div3 = document.createElement('div');
                        div3.classList.add('cart-hover-product-price-wrap');
                        div2.appendChild(div3);

                        var span = document.createElement('span');
                        span.classList.add('cart-hover-product-price');
                        span.textContent = price;
                        div3.appendChild(span);

                        var ul = document.querySelector('.cart-hover-list-product');
                        ul.appendChild(li);

                        var cartQuantity = document.querySelector('span[name="QuantityProduct"]');
                        var currentQuantity = parseInt(cartQuantity.textContent);
                        cartQuantity.textContent = currentQuantity + 1;        
                    }
                    else {
                        alert("Sản phẩm đã có trong giỏ hàng !!!");
                    }        
                } else {
                    // Xử lý logic khi lỗi

                }
            }
        };
        xhr.open('GET', '/cart/add/' + productId);
        xhr.send();                           
    });
    
    function addEventBtnReportComment() {
        var reportButtons = document.querySelectorAll('button[name="BtnReportComment"]');
        reportButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Lấy giá trị CommentId từ thuộc tính "data-comment-id" của phần tử div
                var commentId = this.closest('.row').querySelector('[id^="Comment-id-"]').getAttribute('data-comment-id');
                console.log(commentId);
                // Gán giá trị CommentId vào input "ReportCommentId" trong modal
                var inputReportCommentId = document.querySelector('input[name="ReportCommentId"]');
                inputReportCommentId.value = commentId;
            });
        });
    }
    addEventBtnReportComment();

    var productPrice = document.querySelector('#inputPrice');
    var price = parseInt(productPrice.innerText); 
    price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    productPrice.innerText = price;

    function showChatBox() {
        var chatBox = document.querySelector('.ChatBox');
        chatBox.classList.remove('hidden');
        var content = document.getElementById("contentMessage");
        content.scrollTop = content.scrollHeight;
        lastId = 0;
        myInterval = setInterval(function() {GetMessage()}, 1000);  
    }

    var ButtonSubmitComment = document.querySelector('#ButtonSubmitComment');
    var userId = document.querySelector('#user-id').textContent;
    var productId = document.querySelector('#product-id').textContent;

    ButtonSubmitComment.addEventListener("click", function() {
        var commentInputElement = document.querySelector('#commentInputElement');
        var commentValue = commentInputElement.value;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response);    
                    var imageAvatar = response.imageAvatar;    
                    var userName = response.userName;                     
                    var commentContent = response.commentContent;
                    var commentDate = response.commentDate;
                    var newItem = document.createElement('div');
                    newItem.setAttribute('name', 'BoxComment');
                    newItem.innerHTML = `
                        <div class="mb-3 row" style="text-align: left;">
                            <div class="col-1" style="text-align: center;">
                                <img src="${imageAvatar ? '/images/AvatarImage/' + imageAvatar : '/images/AvatarImage/defaultAvatarProfile.jpg'}" 
                                    class="rounded-circle" style="width: 50px; height: 50px;" alt="Avatar" />
                            </div>
                            <div class="col-11" style="text-align: left; ">
                                <div class="row">
                                    <h6 style="margin: 0">${userName}</h6>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        ${commentDate}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-4">
                                        ${commentContent}
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <hr>
                    `;

                    var BoxComment = document.querySelector('.BoxComment');
                    BoxComment.prepend(newItem);
                } else {
                    // Xử lý logic khi lỗi

                }
            }
        };
        xhr.open('POST', '/SaveComment');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            userId: userId,
            productId: productId,
            commentValue: commentValue,
            create_at: moment(Date.now()).utcOffset(7).format('YYYY-MM-DD HH:mm:ss')
        };
        xhr.send(JSON.stringify(data));
    });

    function DisplayRating(ListButtonRate, ratingValue) {
        for (var i = 0; i < ListButtonRate.length; i++) {
            if(ListButtonRate[i].value == ratingValue) {
                ListButtonRate[i].checked = true;
            }
        }
    }

    var ButtonRatingComment = document.querySelectorAll('label[name="ratingSubmit"]'); 
        for (var i = 0; i < ButtonRatingComment.length; i++) {
            (function(index) {
                ButtonRatingComment[index].addEventListener("click", function() {
                    var rating = ButtonRatingComment[index].getAttribute("value");
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {   
                                var response = JSON.parse(xhr.response);    
                                var ButtonRatingRate = document.querySelectorAll('input[name="ratingRate"]'); 
                                DisplayRating(ButtonRatingRate, response.ratingValue);
                            } else {
                                // Xử lý logic khi lỗi
                            }
                        }
                    };
                    xhr.open('POST', '/SaveRating');
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    var data = {
                        userId: userId,
                        productId: productId,
                        ratingValue: rating,
                        create_at: moment(Date.now()).utcOffset(7).format('YYYY-MM-DD')
                    };
                    xhr.send(JSON.stringify(data));
                });
            })(i);
        }

        function RenderUI_Comment(response) 
        {
            var listComment= response.commentData.data; 

            var ListCommentElement = document.getElementById(`BoxComment`);   
            ListCommentElement.innerHTML = "";      

            var CheckUserId = document.querySelector('#user-id').getAttribute('value');

            listComment.forEach((comment) => {     
                var newItem = document.createElement('div');
                newItem.setAttribute('name', 'BoxComment');
                newItem.innerHTML = `
                    <div class="mb-3 row" style="text-align: left;">
                        <div id="Comment-id-${comment.CommentId}" data-comment-id=${comment.CommentId}></div>
                        <div class="col-1" style="text-align: center;">
                            <img src="${comment.ava_img_path  ? '/images/AvatarImage/' + comment.ava_img_path  : '/images/AvatarImage/defaultAvatarProfile.jpg'}" 
                                class="rounded-circle" style="width: 50px; height: 50px;" alt="Avatar" />
                        </div>
                        <div class="col-8" style="text-align: left; ">
                            <div class="row">
                                <h6 style="margin: 0">${comment.Name}</h6>
                            </div>
                            <div class="row">
                                <div class="col">
                                    ${comment.Create_at}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    ${comment.Content}
                                </div>                       
                            </div>
                        </div>
                        <div class="col-sm-3" style="text-align: right;">
                                <button                    
                                    ${CheckUserId ? '' : 'disabled'}    
                                    type="button" class="btn btn-danger" name="BtnReportComment" data-bs-toggle="modal" data-bs-target="#ModalReportComment">
                                        Báo cáo bình luận
                                </button>
                        </div> 
                    </div>
                    <hr>
                `;

                var BoxComment = document.querySelector('.BoxComment');
                BoxComment.prepend(newItem);     
            });

            addEventBtnReportComment();
                // Cập nhật liên kết phân trang
            var paginationLinks = response.commentData.links;
            // Tạo chuỗi HTML cho liên kết phân trang
            var paginationHtml = '<nav"><ul class="pagination">';
            if (paginationLinks[0].url === null) {
                paginationHtml += '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">' + "‹" + '</a></li>';
            } else {
                paginationHtml += `<li class="page-item"><a class="page-link" href="${paginationLinks[0].url}">‹</a></li>`;
            }
            for (var i = 1; i < paginationLinks.length - 1; i++) {
                if (paginationLinks[i].active) {
                    paginationHtml += `<li class="page-item active"><a class="page-link" href="${paginationLinks[i].url}">${paginationLinks[i].label}</a></li>`;
                } else {
                    paginationHtml += `<li class="page-item"><a class="page-link" href="${paginationLinks[i].url}">${paginationLinks[i].label}</a></li>`;
                }
            }
            if (paginationLinks[paginationLinks.length - 1].url === null) {
                paginationHtml += '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">' + "›" + '</a></li>';
            } else {
                paginationHtml += `<li class="page-item"><a class="page-link" href="${paginationLinks[paginationLinks.length - 1].url}">›</a></li>`;
            }
            paginationHtml += '</ul></nav>';

            // Thêm chuỗi HTML cho liên kết phân trang vào trang web
            document.getElementById(`PaginationComment`).innerHTML = paginationHtml; 

            // Lấy tất cả các thẻ a trong phân trang của laravel- first time
            const paginationLinks_NewProduct = document.querySelectorAll('#PaginationComment a');
                // Lặp qua từng thẻ a và thêm sự kiện click
            paginationLinks_NewProduct.forEach(link => {
                link.addEventListener('click', event => {
                    // Ngăn chặn hành vi mặc định của thẻ a
                    event.preventDefault();
                    var productId = document.querySelector('#product-id').textContent;
                    // Tạo URL mới với tham số SearchValue
                    const url = new URL(link.href);
                    const params = new URLSearchParams(url.search);
                    params.set('ProductId', productId);

                    url.pathname = '/detailProduct/Comment_Pagination';
                    url.search = params.toString();
                
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // Xử lý kết quả tìm kiếm và cập nhật giao diện
                            var response = JSON.parse(xhr.response);  
                            RenderUI_Comment(response); 
                            
                        }
                        else {
                        // Xử lý lỗi
                        }   
                    }
                    };
                    xhr.open('GET', url.toString(), true);
                    xhr.send();
                });
            });
        }

        // Lấy tất cả các thẻ a trong phân trang của laravel- first time
        const paginationLinks_NewProduct = document.querySelectorAll('#PaginationComment a');
            // Lặp qua từng thẻ a và thêm sự kiện click
        paginationLinks_NewProduct.forEach(link => {
            link.addEventListener('click', event => {
                // Ngăn chặn hành vi mặc định của thẻ a
                event.preventDefault();
                var productId = document.querySelector('#product-id').textContent;
                // Tạo URL mới với tham số SearchValue
                const url = new URL(link.href);
                const params = new URLSearchParams(url.search);
                params.set('ProductId', productId);

                url.pathname = '/detailProduct/Comment_Pagination';
                url.search = params.toString();
            
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Xử lý kết quả tìm kiếm và cập nhật giao diện
                        var response = JSON.parse(xhr.response);  
                        RenderUI_Comment(response); 
                        
                    }
                    else {
                    // Xử lý lỗi
                    }   
                }
                };
                xhr.open('GET', url.toString(), true);
                xhr.send();
            });
        });
</script>
@endsection

