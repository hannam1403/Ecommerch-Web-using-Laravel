@extends('Admin.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
              <i class="mdi mdi-download text-muted"></i>
            </button>
            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
              <i class="mdi mdi-clock-outline text-muted"></i>
            </button>
            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
              <i class="mdi mdi-plus text-muted"></i>
            </button>
            {{-- <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
              Add Product 
            </button> --}}
          </div>     
          {{-- <div class="col-lg-12 grid-margin stretch-card">
            <form action="/ProductCommentManager/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <label for="var_search">
                  <button type="submit" class="btn btn-outline-primary">Search</button>
                </label>
              </div>
            </form>
          </div>    --}}
          <br><br>  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thông tin báo cáo sản phẩm</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Mã người dùng báo cáo</th>
                        <th>Mã shop bị báo cáo</th>
                        <th>Mã sản phẩm bị báo cáo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($reports as $report) 
                      <tr>
                        <td hidden>{{ $report->Id }}</td>
                        <td>{{ $report->MemberId }}</td>
                        <td>{{ $report->ShopId }}</td>
                        <td>{{ $report->ProductId }}</td>
                        <td hidden>{{ $report->Content }}</td>
                        <td hidden>{{ $report->ProductName }}</td>
                        <td hidden>{{ $report->ProductDescription }}</td>
                        <td hidden>{{ $report->ProductPrice }}</td>
                        {{-- <td hidden>{{ $report->Image }}</td> --}}
                        <td>
                          <button class="btn-edit btn btn-primary btn-rounded"
                              data-bs-toggle="modal" data-bs-target="#modalReport">Chi tiết sản phẩm</button>                          
                          <a href="/ReportProductManager/Delete/{{$report->Id}}" onclick="return confirmDelete(event)">
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

    {{-- <div class="pagination justify-content-center pt-5">
      {{ $reports->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>  --}}
    {{-- @include('Product.editProduct') --}}
    
    <!-- Modal -->
<div class="modal fade" id="modalReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="overflow: auto;">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nội dung báo cáo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="overflow-y: auto;">
            <div id="info-product" class="row align-items-stretch" style="height: 450px; padding-bottom: 20px; padding-top: 30px; background-color: rgba(0, 0, 0, 0.05);">
              <div class="col-6">        
                  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="margin-left: 10px;">
                      <div class="carousel-inner" id="info-product-images">               

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
              <div class="col-6" >           
                  <div class="mb-3 row">
                      <div class="col-sm-10">
                          <h4 style="text-align: left;" id="inputNameProduct">Name: </h4>
                      </div>    
                  </div>         
                  <div class="mb-3 row">
                    <label for="inputPrice" class="col-sm-2 col-form-label" style="text-align: left;">Price</label>
                    <div class="col-sm-5">
                      <div class="form-control-plaintext" id="inputPrice"></div>
                    </div>
                  </div>   
              </div>    
            </div>
            <div class="row align-items-stretch" style="margin-top: 20px; padding-bottom: 20px; padding-top: 20px; background-color: rgba(0, 0, 0, 0.05);">
              <div class="col" style="text-align: left;">
                  <h4>MÔ TẢ SẢN PHẨM</h4>
                  <div  style="text-align: left;" id="inputDescription">

                  </div>
              </div>
            </div>
            <div class="row align-items-stretch" style="margin-top: 20px; padding-bottom: 20px; padding-top: 20px; background-color: rgba(0, 0, 0, 0.05);">
              <label for="inputReport" class="col-sm-2 col-form-label">Nội dung Báo cáo</label>
              <div class="col-sm-10">
                  <textarea readonly type="text" class="form-control" id="inputReport"  name="report" rows="10" style="overflow-y: scroll;">
                  </textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
    </div>
    <script>
        // Đăng ký sự kiện click cho nút Edit
        document.querySelectorAll('.btn-edit').forEach(function(button) {
          button.addEventListener('click', function(event) {

            // Lấy dữ liệu của hàng được chọn
            var productId =  event.target.closest('tr').querySelector('td:nth-child(4)').textContent;
            var report = event.target.closest('tr').querySelector('td:nth-child(5)').textContent;
            var nameproduct = event.target.closest('tr').querySelector('td:nth-child(6)').textContent;
            var description = event.target.closest('tr').querySelector('td:nth-child(7)').textContent;
            var price = event.target.closest('tr').querySelector('td:nth-child(8)').textContent;

            
            // Điền dữ liệu vào modal
           
            
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Xử lý kết quả tìm kiếm và cập nhật giao diện
                        var response = JSON.parse(xhr.response);  
                        var product = response.product;
                        var images = response.images;
                        var infoProductImages = document.getElementById("info-product-images");
                        infoProductImages.innerHTML = "";

                        images.forEach(function(image, key) {
                          var div = document.createElement("div");
                          div.className = "carousel-item";
                          if (key == 0) {
                            div.className += " active";
                          }

                          var img = document.createElement("img");
                          img.src = "/images/Product/" + image.ImgProductPath;
                          img.className = "d-block w-100";
                          img.style = "width: 350px; height: 400px;";
                          img.id = "KeyImage-" + key;
                          img.alt = "...";

                          div.appendChild(img);
                          infoProductImages.appendChild(div);

                          document.getElementById("inputReport").value = report;
                          document.getElementById("inputNameProduct").innerText = product[0].Name;
                          document.getElementById("inputDescription").innerHTML = product[0].Description;
                          document.getElementById("inputPrice").innerText = product[0].Price;
                        });                                                                    
                    }
                    else {
                    // Xử lý lỗi
                    }   
                }
            };
            xhr.open('GET', `/GetDataProductById?ProductId=${productId}`);
            xhr.send();
          });
        });
    </script>
      
    <script>
      function confirmDelete(event) {
          if (!confirm("Bạn có chắc chắn muốn xóa báo cáo này?")) {
              event.preventDefault();
              return false;
          }
          return true;
      }
  </script>
@endsection