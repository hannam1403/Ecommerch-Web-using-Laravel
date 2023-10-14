@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <form class="form-inline d-flex mb-2" action="/ImageProductManager/Search" method="GET">
              <input id="SearchValue" name="SearchValue" @if($SearchValue != null) value="{{$SearchValue}}" @endif class="form-control rounded me-1" type="text" placeholder="Search by name ..." aria-label="Search" aria-describedby="search-addon">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalAddImageProduct">
              Add Product Picture
            </button>
          </div>    
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Image Product</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Pic</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($products as $product) 
                      <tr>
                        <td hidden>{{ $product->ID }}</td>
                        <td hidden>{{ $product->ProductID }}</td>
                        <td>{{ $product->ProductName }}</td>
                        <td>
                          <img src="{{ asset('images/Product/'.$product->Pic) }}" style="width: 100px; height: 100px;">
                        </td>
                        <td>                     
                          <a href="/ImageProductManager/DeleteImage/{{$product->ID}}" onclick="return confirmDelete(event)">
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
      {{ $products->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>
    @include('Product.addImageProduct')

    <script>
      // Lấy giá trị của phần tử input
      var SearchValue = document.getElementById("SearchValue").value;
      // Lấy tất cả các thẻ a trong phân trang của laravel
      const paginationLinks = document.querySelectorAll('.pagination a');
      // Lặp qua từng thẻ a và thêm sự kiện click
      paginationLinks.forEach(link => {
          link.addEventListener('click', event => {
              // Ngăn chặn hành vi mặc định của thẻ a
              event.preventDefault();
              // Tạo URL mới với tham số SearchValue
              const url = new URL(link.href);
              const params = new URLSearchParams(url.search);
              params.set('SearchValue', SearchValue);

              url.search = params.toString();

              // Chuyển hướng tới URL mới
              location.href = url.href;
          });
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