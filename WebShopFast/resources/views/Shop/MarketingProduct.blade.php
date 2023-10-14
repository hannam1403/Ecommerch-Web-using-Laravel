@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <form class="form-inline d-flex mb-2" action="/MarketingProduct" method="GET">
              <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 70%">
              <select class="me-1" name="marketing_id">
                <option value="" {{ !$selectedMarketingId ? 'selected' : '' }}>Choose...</option>
                <?php
                  $marketingIds = DB::table('marketing')
                                  ->get();
                foreach ($marketingIds as $marketingId)
                {
                ?>
                    <option value="{{ $marketingId->Id }}" @if ($marketingId == $selectedMarketingId ? 'selected' : '') selected @endif>{{ $marketingId->Name }}</option>
                <?php
                }
                ?>
            </select>
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <button class="btn btn-primary mt-2 mt-xl-0 float-right" data-bs-toggle="modal" data-bs-target="#modalAddMarketing">
              Thêm Mới Marketing Sản Phẩm
            </button>
          </div>     
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <a class="link-secondary" href="/MarketingProduct" style="text-decoration: none">
                  <h4 class="card-title">Sản Phẩm Đang Marketing</h4>
                </a>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Makerting</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($marketing as $data) 
                      <tr>
                        <td hidden>{{ $data->Id }}</td>
                        <td>{{ $data->ProductName }}</td>
                        <td>{{ $data->MarketingName }}</td>
                        <td>{{ $data->ExpiryDate }}</td>
                        <td>                      
                          <a href="/MarketingProduct/Delete/{{$data->Id}}" onclick="return confirmDelete(event)">
                            <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Delete</button>
                          </a>                    
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <div class="pagination justify-content-center pt-5">
      {{ $marketing->appends(['search' => $search])->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>

    <div class="modal fade" id="modalAddMarketing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputProduct" class="col-sm-2 col-form-label">Sản Phẩm</label>
                        <div class="col-sm-10">
                            <select class="form-select mb-3" aria-label=".form-select-lg example" name="ProductId" id="ProductId" > 
                                <?php 
                                    // $products =  DB::select("select distinct product.Id as Id, product.Name as Name from product left join marketingproduct on product.Id = marketingproduct.ProductId where product.user_id = :user_id and marketingproduct.Status != 1 or marketingproduct.ProductId is null", 
                                    // [
                                    //     "user_id" => Session::get('my_user_id')
                                    // ]);
                                    // $products = DB::table('product')
                                    //             ->select('product.Id as Id', 'product.Name as Name')
                                    //             ->distinct()
                                    //             ->leftJoin('marketingproduct', 'product.Id', '=', 'marketingproduct.ProductId')
                                    //             ->whereNull('marketingproduct.ProductId')
                                    //             ->orWhere('marketingproduct.Status', '<>', 1)
                                    //             ->where('product.user_id', Session::get('my_user_id'))
                                    //             ->get();
                                    $products = DB::table('product')
                                                ->whereNotIn('product.Id', function ($query){
                                                  $query->select('marketingproduct.ProductId')
                                                        ->from('marketingproduct')
                                                        ->where('marketingproduct.Status', '=', 1);
                                                })
                                                ->where('product.user_id', Session::get('my_user_id'))
                                                ->select('product.Id as Id', 'product.Name as Name')
                                                ->where('product.deleted','=','0')
                                                ->distinct()
                                                ->get();
                                    foreach ($products as $product) {
                                ?>                               
                                            <option value={{$product->Id}} >{{$product->Name}}</option>                         
                                <?php
                                    }
                                ?>   
                            </select>                               
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputMarketing" class="col-sm-2 col-form-label">Marketing</label>
                        <div class="col-sm-10">
                            <select class="form-select mb-3" aria-label=".form-select-lg example" name="MarketingId" id="inputMarketing"> 
                                <?php 
                                    $Marketings =  DB::select("select * from Marketing");
                                    foreach ($Marketings as $Marketing) {
                                ?>                               
                                            <option value={{$Marketing->Id}} data-price={{$Marketing->Price}}>{{$Marketing->Name}}</option>                         
                                <?php
                                    }
                                ?>   
                            </select>                               
                        </div>
                    </div>      
                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="inputDescription" class="col-sm-2 col-form-label">Price</label>
                        </div>
                        <div class="col-sm-10">
                            <input  type="text" readonly class="form-control"  name="PriceMarketingInput" id="PriceMarketingInput">   
                        </div>
                    </div>                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="SaveMarketingProduct" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>      
        var priceValue = document.getElementById('inputMarketing')[0].getAttribute("data-price");
        document.getElementById('PriceMarketingInput').value = priceValue;
        document.getElementById('inputMarketing').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex]; 
            var price = selectedOption.getAttribute('data-price'); 
            document.getElementById('PriceMarketingInput').value = price;
        });

        var btnSaveMarketingProduct = document.getElementById('SaveMarketingProduct');
        btnSaveMarketingProduct.addEventListener('click', function(e) { 
            var selectElementProduct = document.getElementById("ProductId"); 
            var selectedOptionProduct = selectElementProduct.options[selectElementProduct.selectedIndex]; // lấy phần tử option được chọn
            var productId = selectedOptionProduct.value; 

            var selectElementMarketing = document.getElementById("inputMarketing");
            var selectedOptionMarketing = selectElementMarketing.options[selectElementMarketing.selectedIndex];
            var marketingId = selectedOptionMarketing.value;

            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {   
                        var response = JSON.parse(xhr.response);                             
                        if(response.IsSucces == true) 
                        {
                            alert("Thêm mới thành công");               
                        }
                        else 
                        {
                            alert("Không đủ số tiền trong tài khoản để marketing");
                        }
                        location.reload();
                    } else {
                        // Xử lý logic khi lỗi

                    }
                }
                };
                xhr.open('POST', '/AddProductWithMarketing');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                var data = {
                    productId: productId,
                    marketingId: marketingId
            };
            xhr.send(JSON.stringify(data));
        });

    </script> 

    <script>
      function confirmDelete(event) {
          if (!confirm("Are you sure you want to delete this product?")) {
              event.preventDefault();
              return false;
          }
          return true;
      }
    </script>
@endsection