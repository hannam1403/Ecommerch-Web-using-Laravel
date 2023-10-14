@extends('layouts.app')
@section('content')
    <!-- category -->
    <section>
        <div class="container pt-5">
          <nav class="row gy-4">
            <div class="col-lg-6 col-md-12">
              <div class="row">
                <div class="col-3">
                  <a href="{{ url('/products/type/1') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-couch fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Nội thất</div> 
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/2') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-basketball-ball fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Thể thao</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/3') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-diamond fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Trang sức & Phụ kiện</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/4') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fa fa-camera fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Máy ảnh & Máy quay phim</div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="row">
                <div class="col-3">
                  <a href="{{ url('/products/type/5') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fa fa-medkit fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Sức khỏe</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/6') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-home fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Đồ gia dụng</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/7') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-guitar fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Nhạc cụ</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/8') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-book fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Sách</div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="row">
                <div class="col-3">
                  <a href="{{ url('/products/type/9') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fa fa-rocket fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Đồ chơi</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/10') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fa fa-laptop fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Máy tính & Laptop</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/11') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-tshirt fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Quần áo</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/12') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-shoe-prints fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Giày dép</div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="row">
                <div class="col-3">
                  <a href="{{ url('/products/type/13') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none"> 
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-mobile fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Đồ điện tử</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/14') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-tools fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Dụng cụ</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/15') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-pencil-ruler fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Giáo dục</div>
                  </a>
                </div>
                <div class="col-3">
                  <a href="{{ url('/products/type/16') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                    <button type="button" class="btn-diff btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                      <i class="fas fa-warehouse fa-xl fa-fw"></i>
                    </button>
                    <div class="text-dark">Khác</div>
                  </a>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </section>
      <!-- category -->

      <section>
        <div class="container my-5">
          <header class="mb-4">
            <h3>Products</h3>
          </header>    
          <div class="row">
            <div class="col-2">
              <div class="sidebar">
                <nav id="sidebarMenu" class="collapse d-lg-block sidebar bg-white" >
                  <ul class="nav flex-column" style="list-style-type: none;">
                      @foreach ($subtypes as $subtype)
                          <li class="nav-item" style="border-bottom: 1px solid; max-width:200px">
                              <a class=" item link-secondary nav-link" style="text-decoration:none;" href="/products/type/{{ $type }}/subtype/{{ $subtype->Id }}">
                                {{ $subtype->Name }}
                              </a>
                          </li>
                      @endforeach
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-10">
              <div class="row">
                  @foreach($products as $product)
                  <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card my-2 shadow-0" name="BoxProduct">
                      <div name="ProductId" value={{$product->Id}}></div>
                      <a href="/detailProduct/{{$product->Id}}">           
                        <img src="{{ asset('images/Product/'.$product->ImgProductPath) }}" name="ProductImage" class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
                      </a>
                      <div class="card-body p-0 pt-3 ps-2">
                        @if($product->QuantityInStock != 0)
                          <button @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif 
                                  name="AddProduct" class="btn btn-light btn-diff border px-2 pt-2 float-end icon-hover"><i class="fas fa-shopping-cart fa-lg px-1 text-secondary"></i></button>
                        @else
                          <h5 class="px-2 pt-2 float-end" style="color: red">Hết hàng</h5>
                        @endif
                        <h5 class="card-title" name="ProductPrice" value={{$product->Price}}>{{$product->Price}}</h5>
                        <p class="card-text mb-0" name="ProductName">{{$product->Name}}</p>
                        <p class="text-muted">
                          Subtype: {{$product->subcategoryName}}
                        </p>
                      </div>
                    </div>
                  </div>
                @endforeach    
                <div id="PaginationNewProductSubtype" style="display: flex; justify-content: center; align-items: center;">
                  {{ $products->links() }}        
                </div>                 
              </div>    
            </div>                       
          </div>
        </div>
      </section>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var productsPrice = document.querySelectorAll('h5[name="ProductPrice"]');
      for(var i = 0; i < productsPrice.length; i++) {
        var price = parseInt(productsPrice[i].innerText); 
        price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        productsPrice[i].innerText = price;
      }
      
      var products = document.querySelectorAll('div[name="BoxProduct"]');
      for (var i = 0; i < products.length; i++) {
        var IdElement = products[i].querySelectorAll('div[name="ProductId"]')[0];
        var ImageElement = products[i].querySelectorAll('img[name="ProductImage"]')[0];
        var NameElement = products[i].querySelectorAll('p[name="ProductName"]')[0];
        var PriceElement = products[i].querySelectorAll('h5[name="ProductPrice"]')[0];
        var AddProductElement = products[i].querySelectorAll('button[name="AddProduct"]')[0];
        var Id = IdElement.getAttribute('value');;
        var imageUrl = ImageElement.getAttribute('src');
        var name = NameElement.textContent;
        var price = PriceElement.textContent;
        (function(Id, imageUrl, name, price) {
          if (AddProductElement !== undefined) {
            AddProductElement.addEventListener('click', function(e) {
              $.ajax({
                url: '/cart/add/' + Id,
                type: 'GET',
                success: function (response) {
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
                },
                error: function (xhr, status, error) {
                    // Xử lý logic khi lỗi
                }
              });
              
            });    
          }                 
        })(Id, imageUrl, name, price);
      }
    </script>
@endsection

<style>
  .btn-diff{
    height: 50px;
  }

  .sidebar a:hover{
    background-color: rgb(207, 204, 204);
  }
  .sidebar a.active{
    background-color: gray;
  }
</style>