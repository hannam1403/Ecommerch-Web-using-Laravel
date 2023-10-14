<style>
  @keyframes fadeIn {
    0% {opacity: 0;}
    100% {opacity: 1;} 
 } 

.header-cart{
    position: relative;
    display: inline-block;
    cursor: pointer;
    width: 50px;
}

.header-cart:hover .cart-hover {
    display: block;
}

.cart-icon-wrap{
    position: relative;
    display: none;
    width: 35px;
}

.cart-icon-wrap-notice{
    position: absolute;
    background-color: orange;
    bottom: 20px;
    padding: 2px 7px;
    font-size: 1.0rem;
    line-height: 1.1rem;
    border-radius: 50px;
}

.cart-icon{
    height: 35px;
    margin-left: 6px;
    width: 10px;
}

.cart-hover{
    width: 500px;
    box-shadow: 0 1px 3.125rem 0 rgba(0,0,0,0.1);
    z-index: 8;
    margin-top: 55px;
    margin-right: 10px;
    display: none;
    background-color: white;
    align-items: center;
    border-radius: 2px;
    animation: fadeIn ease-in 0.3s;
    cursor: default;
}

.cart-hover::after{
    content: "";
    position: absolute;
    right: 448px;
    top: -30px;
    border-width: 15px 26px;
    border-style: solid;
    border-color: transparent transparent lightgray transparent;
}

.img-no-cart{
    width: 80%;
    height: 90%; 
    cursor: default;
    display: none;
}

.cart-hover-product-heading{
    margin: 12px;
    text-align: left;
    font-size: 1.4rem;
    color: #999;
    font-weight: 40;
}

.cart-hover-list-product{
    padding-left: 0;
    list-style: none;
}

.cart-hover-product{
    display: flex;
}

.cart-hover-img{
    width: 60px;
    height: 60px;
    margin: 6px;
    border: 1px solid black;
}

.cart-hover-list-product{
    cursor: default;
    overflow-y: scroll;
    height: 220px;
}

.cart-hover-product:hover{
    background-color: rgb(240, 236, 236);
}

.cart-hover-product-info{
    width: 100%;
    align-items: center;
}

.cart-hover-product-head{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cart-hover-product-name{
    font-size: 1.4rem;
    font-weight: 500;
    color: black;
    margin: 0;
}

.cart-hover-product-price{
    font-size: 1.4rem;
    font-weight: 400;
    color: red;
}

.cart-hover-product-multiply{
    font-size: 0.9rem;
    margin: 0 4px;
    color: #757575;
}

.cart-hover-product-quantity{
    color: #757575;
    font-size: 1.2rem;
}
.cart-hover-delbtn{
    margin-left: 83%;
}
</style>
@if (session('my_user_id'))
    <style>
      .cart-icon-wrap{
        display: inline-block;
      }
    </style>
@endif
<header style="position: fixed;top: 0;left: 0;width: 100%;height: 50px; z-index: 9;">
      <!-- Jumbotron -->
      <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
          <div class="row gy-3">
            <!-- Left elements -->
            <div class="col-lg-2 col-sm-4 col-4">
              <a href="{{ url('/') }}"  class="float-start">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" height="35" />
              </a>
            </div>
            <!-- Left elements -->
    
            <!-- Center elements -->
            <div class="order-lg-last col-lg-5 col-sm-8 col-8">
              <div class="header-cart d-flex float-start">
                <div class="cart-icon-wrap">
                  <a class="cart-icon-wrap" href="/DetailCart">
                    <i class="cart-icon fa fa-shopping-cart pe-5 fa-2x pt-1" style="color: blue " aria-hidden="true"></i>
                  </a>
                  <?php 
                    $data = DB::select("call GetQuantityCartDetail(:user_id)", 
                    [
                            'user_id' => session('my_user_id')
                    ]);
                  ?>
                  <span class="cart-icon-wrap-notice" name="QuantityProduct">{{$data[0]->Count}}</span>
                </div>
                <!-- No cart: img_no_cart -->
                <div class="cart-hover position-absolute">
                  {{-- <img class="img-no-cart" src="./images/Cart/nocart.jpg"> --}}
                  <h4 class="cart-hover-product-heading pt-2">Sản phẩm đã thêm</h4>
                  <ul class="cart-container cart-hover-list-product">
                    <?php 
                      $products =  DB::select("CALL GetCartDetail(:id)", 
                      [
                          "id" => session('my_user_id')
                      ]);
                      foreach ($products as $product) {
                        $image =  DB::select("SELECT * from imageproduct WHERE imageproduct.ProductId = :ProductId LIMIT 1;", 
                        [
                            "ProductId" => $product->ProductId
                        ]);
                    ?>    
                      <li class="cart-items cart-hover-product">
                        <img src="{{ asset('images/Product/'.$image[0]->ImgProductPath) }}" class="cart-hover-img">
                        <div class="cart-hover-product-info">
                          <div class="cart-hover-product-head pe-3">
                            <h5 class="cart-hover-product-name">{{$product->Name}}</h5>
                            <div class="cart-hover-product-price-wrap">
                              <span class="cart-hover-product-price">{{$product->Price}} VND</span>
                            </div>
                          </div>
                        </div>
                      </li>    
                    <?php } ?>     
                  </ul>
                </div>
              </div>
              <div class="d-flex float-end align-middle">
                @if(Session::has('username') && !empty(Session::get('username')))
                  <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-user-alt m-1 me-md-2"></i>  {{ Session::get('username') }}
                    </button>
                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="/detailAccount/{{ Session::get('my_user_id')}}">My Account</a></li>
                      <li><a class="dropdown-item" href="/CustomerOrders/{{ Session::get('my_user_id')}}">My Order</a></li>
                      <li><a class="dropdown-item" href="/AddressManager">My Address</a></li>
                      <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                  </div>
                @else 
                  <a href="/register" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center" > 
                    <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Sign up</p> 
                  </a>
                  <a href="/login" class="border rounded py-1 px-3 nav-link d-flex align-items-center" > 
                    <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Sign in</p> 
                  </a>
                @endif                
              </div>                          
            </div>
            <!-- Center elements -->
    
            <!-- Right elements -->

            <div class="col-lg-5 col-md-auto col-12">
              <form action="/search" method="PUT">
                <div class="input-group">
                  <input type="search" 
                    @if(isset($var_search))
                      @if($var_search != null) value="{{$var_search}}" @endif
                    @endif   
                    id="var_search" name="var_search"  class="form-control rounded" placeholder="Search by name ..." aria-label="Search" aria-describedby="search-addon" />
                  <label for="var_search">
                    <button type="submit" class="btn btn-outline-primary">search</button>
                  </label>
                </div>
              </form>

            </div>
            <!-- Right elements -->
          </div>
        </div>
      </div>
      <!-- Jumbotron -->
      <!-- message thong bao thanh cong hay that bai -->
      @include('error')

       <!-- End message thong bao thanh cong hay that bai -->
</header>
