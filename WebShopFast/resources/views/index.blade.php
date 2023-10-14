@extends('layouts.app')
@section('content')
    <!--Main Navigation-->
    <!-- Slideshow  -->
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('images/Banner/'.$banner->Picture) }}"
                    style="height: 400px"
                    class="d-block w-100" alt="...">
            </div>
        @endforeach
    </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- End Slideshow  -->
    <!-- category -->
    <section>
      <div class="container pt-5">
        <nav class="row gy-4">
          <div class="col-lg-6 col-md-12">
            <div class="row">
              <div class="col-3">
                <a href="{{ url('/products/type/1') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-couch fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Nội thất</div> 
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/2') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-basketball-ball fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Thể thao</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/3') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-diamond fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Trang sức & Phụ kiện</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/4') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
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
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fa fa-medkit fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Sức khỏe</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/6') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-home fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Đồ gia dụng</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/7') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-guitar fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Nhạc cụ</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/8') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
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
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fa fa-rocket fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Đồ chơi</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/10') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fa fa-laptop fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Máy tính & Laptop</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/11') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-tshirt fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Quần áo</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/12') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
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
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-mobile fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Đồ điện tử</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/14') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-tools fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Dụng cụ</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/15') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
                    <i class="fas fa-pencil-ruler fa-xl fa-fw"></i>
                  </button>
                  <div class="text-dark">Giáo dục</div>
                </a>
              </div>
              <div class="col-3">
                <a href="{{ url('/products/type/16') }}" class="text-center d-flex flex-column justify-content-center" style="text-decoration:none">
                  <button type="button" class="btn btn-outline-secondary mx-auto p-3 mb-2" data-mdb-ripple-color="dark">
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
    
    <!-- Products -->
    <section>
      @foreach($listMarketingProduct as $marketingProduct)
        @if(count($marketingProduct->getProducts()) > 0)
          <div class="container my-5">
            <header class="mb-4">
              <h3 style="color: red">{{$marketingProduct->getNameMakerting()}}</h3>
            </header>
        
            <div class="row" id="ProductMarketing-{{$marketingProduct->IdMarketing}}">
              @foreach($marketingProduct->getProducts() as $product)
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="card my-2 shadow-0" name="BoxProduct">
                    <div name="ProductId" value={{$product->Id}}></div>
                    <a href="/detailProduct/{{$product->Id}}">           
                      <img src="{{ asset('images/Product/'.$product->ImgProductPath) }}" name="ProductImage" class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
                    </a>
                    <div class="card-body p-0 pt-3 ps-2">
                      @if($product->QuantityInStock != 0)
                        <button  
                          @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif
                          name="AddProduct" class="btn btn-light border px-2 pt-2 float-end icon-hover"><i class="fas fa-shopping-cart fa-lg px-1 text-secondary"></i></button>
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
            </div>
            <div id="PaginationMarketing-{{$marketingProduct->IdMarketing}}" value="{{$marketingProduct->IdMarketing}}" style="display: flex; justify-content: center; align-items: center;">
              {{ $marketingProduct->getProducts()->onEachSide(1)->links() }}     
            </div>
          </div>
        @endif
      @endforeach
      

      <div class="container my-5">
        <header class="mb-4">
          <h3>New products</h3>
        </header>
    
        <div class="row" id="ListNewProductElement">
          @foreach($dataProducts as $product)
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card my-2 shadow-0" name="BoxProduct">
                <div name="ProductId" value={{$product->Id}}></div>
                <a href="/detailProduct/{{$product->Id}}">           
                  <img src="{{ asset('images/Product/'.$product->ImgProductPath) }}" name="ProductImage" class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
                </a>
                <div class="card-body p-0 pt-3 ps-2">
                  @if($product->QuantityInStock != 0)
                    <button @if(!Session::has('my_user_id') || Session::get('my_user_id') == null) disabled @endif
                            name="AddProduct" class="btn btn-light border px-2 pt-2 float-end icon-hover"><i class="fas fa-shopping-cart fa-lg px-1 text-secondary"></i></button>
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
        </div>
        <div id="PaginationNewProduct" style="display: flex; justify-content: center; align-items: center;">
          {{ $dataProducts->onEachSide(4)->links() }}        
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var productsPrice = document.querySelectorAll('h5[name="ProductPrice"]');
      for(var i = 0; i < productsPrice.length; i++) {
        var price = parseInt(productsPrice[i].getAttribute('value')); 
        price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        productsPrice[i].innerText = price;
      }
      
      function AddProductToCartEvent(products) 
      {
        //var products = document.querySelectorAll('div[name="BoxProduct"]');

        for (var i = 0; i < products.length; i++) {
          var IdElement = products[i].querySelectorAll('div[name="ProductId"]')[0];
          var ImageElement = products[i].querySelectorAll('img[name="ProductImage"]')[0];
          var NameElement = products[i].querySelectorAll('p[name="ProductName"]')[0];
          var PriceElement = products[i].querySelectorAll('h5[name="ProductPrice"]')[0];
          var AddProductElement = products[i].querySelectorAll('button[name="AddProduct"]')[0];
          var Id = IdElement.getAttribute('value');
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
      }
      
      AddProductToCartEvent(document.querySelectorAll('div[name="BoxProduct"]'));

      function RenderUI_NewProduct(response)
      {
        var ListNewProductElement = document.getElementById("ListNewProductElement");
        ListNewProductElement.innerHTML = "";
        var listNewProduct = response.dataProducts.data;   
        
        listNewProduct.forEach((product) => {                          
          var newItem = document.createElement('div');
          newItem.classList.add('col-lg-3');
          newItem.classList.add('col-md-6');
          newItem.classList.add('col-sm-6');
          newItem.innerHTML = `
                <div class="card my-2 shadow-0" name="BoxProduct">
                    <div name="ProductId" value="${product.Id}"></div>
                    <a href="/detailProduct/${product.Id}">           
                        <img src="{{ asset('images/Product/${product.ImgProductPath}') }}" name="ProductImage" class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
                    </a>
                    <div class="card-body p-0 pt-3 ps-2">
                        ${product.QuantityInStock != 0 ? `
                        <button name="AddProduct" class="btn btn-light border px-2 pt-2 float-end icon-hover">
                            <i class="fas fa-shopping-cart fa-lg px-1 text-secondary"></i>
                        </button>
                        ` : `
                        <h5 class="px-2 pt-2 float-end" style="color: red">Hết hàng</h5>
                        `}
                        <h5 class="card-title" name="ProductPrice" value=${product.Price}>${product.Price}</h5>
                        <p class="card-text mb-0" name="ProductName">${product.Name}</p>
                        <p class="text-muted">
                          Subtype: ${product.subcategoryName}
                        </p>
                    </div>
                </div>
            `;          
          ListNewProductElement.appendChild(newItem);                        
        });
     
        // Cập nhật liên kết phân trang
        var paginationLinks = response.dataProducts.links;
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
        document.getElementById('PaginationNewProduct').innerHTML = paginationHtml; 

        var productsPrice = document.querySelectorAll('h5[name="ProductPrice"]');
        for(var i = 0; i < productsPrice.length; i++) {
          var price = parseInt(productsPrice[i].getAttribute('value')); 
          price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
          productsPrice[i].innerText = price;
        }

        AddProductToCartEvent(ListNewProductElement.querySelectorAll('div[name="BoxProduct"]'));

        // Lấy tất cả các thẻ a trong phân trang của laravel- first time
        const paginationLinksElement = document.querySelectorAll('#PaginationNewProduct a');
        // Lặp qua từng thẻ a và thêm sự kiện click
        paginationLinksElement.forEach(link => {
            link.addEventListener('click', event => {
                // Ngăn chặn hành vi mặc định của thẻ a
                event.preventDefault();
                // Tạo URL mới với tham số SearchValue
                const url = new URL(link.href);
                const params = new URLSearchParams(url.search);               
                url.pathname = "/IndexNewProduct_Pagination";
                url.search = params.toString();
              

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Xử lý kết quả tìm kiếm và cập nhật giao diện
                        var response = JSON.parse(xhr.response);  
                        //console.log(IdElementProduct);                      
                        RenderUI_NewProduct(response);
                        
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
      const paginationLinks_NewProduct = document.querySelectorAll('#PaginationNewProduct a');
      var var_search = document.querySelector('#var_search').getAttribute('value');
      console.log(var_search);
        // Lặp qua từng thẻ a và thêm sự kiện click
      paginationLinks_NewProduct.forEach(link => {
          link.addEventListener('click', event => {
              // Ngăn chặn hành vi mặc định của thẻ a
              event.preventDefault();
              // Tạo URL mới với tham số SearchValue
              const url = new URL(link.href);
              const params = new URLSearchParams(url.search);
              
              if(var_search == null) {
                url.pathname = '/IndexNewProduct_Pagination';
              }
              else {
                url.pathname = '/search';
                params.set('var_search', var_search);
                url.search = params.toString();
                location.href = url.href;
              }
              
              url.search = params.toString();
            

              var xhr = new XMLHttpRequest();
              xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                  if (xhr.status === 200) {
                      // Xử lý kết quả tìm kiếm và cập nhật giao diện
                      var response = JSON.parse(xhr.response);  
                      
                      RenderUI_NewProduct(response);
                      
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

      function RenderUI_MarketingProduct(response) 
      {
        var marketing_id = response.marketing_id;  
        var listNewProduct = response.dataProducts.data; 

        var ListProductMaketingElement = document.getElementById(`ProductMarketing-${marketing_id}`);   
        ListProductMaketingElement.innerHTML = "";      

        listNewProduct.forEach((product) => {                          
          var newItem = document.createElement('div');
          newItem.classList.add('col-lg-3');
          newItem.classList.add('col-md-6');
          newItem.classList.add('col-sm-6');
          newItem.innerHTML = `
                <div class="card my-2 shadow-0" name="BoxProduct">
                    <div name="ProductId" value="${product.Id}"></div>
                    <a href="/detailProduct/${product.Id}">           
                        <img src="{{ asset('images/Product/${product.ImgProductPath}') }}" name="ProductImage" class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
                    </a>
                    <div class="card-body p-0 pt-3 ps-2">
                        ${product.QuantityInStock != 0 ? `
                        <button name="AddProduct" class="btn btn-light border px-2 pt-2 float-end icon-hover">
                            <i class="fas fa-shopping-cart fa-lg px-1 text-secondary"></i>
                        </button>
                        ` : `
                        <h5 class="px-2 pt-2 float-end" style="color: red">Hết hàng</h5>
                        `}
                        <h5 class="card-title" name="ProductPrice" value=${product.Price}>${product.Price}</h5>
                        <p class="card-text mb-0" name="ProductName">${product.Name}</p>
                        <p class="text-muted">
                          Subtype: ${product.subcategoryName}
                        </p>
                    </div>
                </div>
            `;          
            ListProductMaketingElement.appendChild(newItem);                        
        });

         // Cập nhật liên kết phân trang
        var paginationLinks = response.dataProducts.links;
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
        document.getElementById(`PaginationMarketing-${marketing_id}`).innerHTML = paginationHtml; 

        var productsPrice = document.querySelectorAll('h5[name="ProductPrice"]');
        for(var i = 0; i < productsPrice.length; i++) {
          var price = parseInt(productsPrice[i].getAttribute('value')); 
          price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
          productsPrice[i].innerText = price;
        }

        AddProductToCartEvent(ListProductMaketingElement.querySelectorAll('div[name="BoxProduct"]'));

        // Lấy tất cả các thẻ a trong phân trang của laravel- first time
        const paginationLinks_MarketingProduct = document.querySelectorAll(`#PaginationMarketing-${marketing_id} a`);
          // Lặp qua từng thẻ a và thêm sự kiện click
        paginationLinks_MarketingProduct.forEach(link => {
          link.addEventListener('click', event => {
              // Ngăn chặn hành vi mặc định của thẻ a
              event.preventDefault();
              // Tạo URL mới với tham số SearchValue
              const url = new URL(link.href);
              const params = new URLSearchParams(url.search);
              params.set('marketing_id', marketing_id);

              url.pathname = '/IndexMarketing_Pagination';
              url.search = params.toString();
            
              var xhr = new XMLHttpRequest();
              xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                  if (xhr.status === 200) {
                      // Xử lý kết quả tìm kiếm và cập nhật giao diện
                      var response = JSON.parse(xhr.response);  
                      
                      RenderUI_MarketingProduct(response);
                      
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
      
      document.querySelectorAll('[id^="PaginationMarketing-"] a').forEach(function(link) {
        link.addEventListener('click', function(event) {
          event.preventDefault();
         
          const marketingId = event.target.closest('[id^="PaginationMarketing-"]').getAttribute("value");
          
          const url = new URL(link.href);
          const params = new URLSearchParams(url.search);
          params.set('marketing_id', marketingId);

          url.pathname = '/IndexMarketing_Pagination';

          url.search = params.toString();
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
              if (xhr.status === 200) {
                  // Xử lý kết quả tìm kiếm và cập nhật giao diện
                  var response = JSON.parse(xhr.response); 
                  RenderUI_MarketingProduct(response);                 
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
    <!-- Products -->
@endsection