@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <form class="form-inline d-flex mb-2" action="/ProductManager/Search" method="GET">
              <input id="SearchValue" name="SearchValue"  @if($SearchValue != null) value="{{$SearchValue}}" @endif class="form-control rounded me-1" type="text" placeholder="Search by ..." aria-label="Search" aria-describedby="search-addon">
              <select class="form-select" id="typeSearch" name="typeSearch" aria-label="Default select example">
                <option value=0 @if($typeSearch == 0) selected @endif >Tất Cả</option>
                <option value=1 @if($typeSearch == 1) selected @endif >Tên Sản Phẩm</option>
                <option value=2 @if($typeSearch == 2) selected @endif >Loại Sản Phẩm</option>
              </select>
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <button class="btn btn-primary mt-2 mt-xl-0" style="margin-bottom: 5px;" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
              Add Product
            </button>
          </div>    
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Product</h4>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <form action="/ProductManager/Sort" method="GET" id="sortForm">                   
                        <input hidden id="IsSortAsc" name="IsSortAsc" type="text" @if($IsSortAsc != null) value="{{$IsSortAsc}}" @endif>
                        <input hidden id="TypeColumn" name="TypeColumn" type="text" @if($TypeColumn != null) value="{{$TypeColumn}}" @endif>
                        <tr>
                          <th>Product Name</th>
                          <th value=1 name="TypeColumn" style="cursor: pointer; color: red;">Price</th>
                          <th value=2 name="TypeColumn" style="cursor: pointer; color: red;">Quantity</th>
                          <th>Category</th>
                          <th>SubCategory</th>
                          <th hidden>Description</th>
                          <th>Action</th>
                        </tr>
                      </form>
                    </thead>
                    <tbody> 
                      @foreach($products as $product) 
                      <tr>
                        <td hidden>{{ $product->Id }}</td>
                        <td>{{ $product->Name }}</td>
                        <td>{{ $product->Price }}</td>
                        <td>{{ $product->QuantityInStock }}</td>
                        <td>{{ $product->CategoryName }}</td>
                        <td>{{ $product->subcategoryName }}</td>
                        <td hidden>{{ $product->Description }}</td>
                        <td>
                          <button class="btn-edit btn btn-primary btn-rounded"
                              data-bs-toggle="modal" data-bs-target="#modalEditProduct">Edit</button>                   
                          <a href="/ProductManager/Delete/{{$product->Id}}" onclick="return confirmDelete(event)">
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
      {{ $products->links() }}
    </div>
    @include('Product.addProduct')
    @include('Product.editProduct')

    <script>
      // Lấy giá trị của phần tử input
      var SearchValue = document.getElementById("SearchValue").value;
      var typeSearchValue = document.getElementById("typeSearch").value;
      var IsSortAsc = document.getElementById("IsSortAsc").value;
      var TypeColumn = document.getElementById("TypeColumn").value;
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
              params.set('typeSearch', typeSearchValue);
              params.set('IsSortAsc', IsSortAsc);
              params.set('TypeColumn', TypeColumn);
              url.search = params.toString();

              // Chuyển hướng tới URL mới
              location.href = url.href;
          });
      });

      const thElements = document.querySelectorAll('th[name="TypeColumn"]');
      const typeColumnInput = document.getElementById('TypeColumn');
      thElements.forEach(th => {
          th.addEventListener('click', () => {
              const typeColumnValue = th.getAttribute('value');
              typeColumnInput.value = typeColumnValue;
              let isSortAscInput = document.getElementById('IsSortAsc');
              let isSortAsc = isSortAscInput.value === '1' ? 0 : 1; // đảo ngược giá trị 
              isSortAscInput.value = isSortAsc; // cập nhật giá trị mới cho input IsSortAsc
              const form = document.getElementById('sortForm');
              form.submit();
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