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
                <h4 class="card-title">Thông tin báo cáo comment</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Mã người dùng báo cáo</th>
                        <th>Mã người dùng bị báo cáo</th>
                        <th>Mã comment bị báo cáo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($reports as $report) 
                      <tr>
                        <td hidden>{{ $report->Id }}</td>
                        <td>{{ $report->MemberId }}</td>
                        <td>{{ $report->ReportedMemberId }}</td>
                        <td>{{ $report->CommentId }}</td>
                        <td hidden>{{ $report->Comment }}</td>
                        <td hidden>{{ $report->Content }}</td>
                        <td>
                          <button class="btn-edit btn btn-primary btn-rounded"
                              data-bs-toggle="modal" data-bs-target="#modalReport">Nội dung báo cáo và comment</button>                          
                          <a href="/ReportCommentManager/Delete/{{$report->Id}}" onclick="return confirmDelete(event)">
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
        <div class="modal-content">
            <form>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nội dung báo cáo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputReport" class="col-sm-2 col-form-label">Báo cáo</label>
                        <div class="col-sm-10">
                          <textarea readonly type="text" class="form-control" id="inputReport" name="report" rows="10" style="overflow-y: scroll;">
                          </textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputComment" class="col-sm-2 col-form-label">Comment</label>
                        <div class="col-sm-10">
                            <textarea readonly type="text-area" class="form-control" id="inputComment"  name="comment" rows="10" style="overflow-y: scroll;">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        // Đăng ký sự kiện click cho nút Edit
        document.querySelectorAll('.btn-edit').forEach(function(button) {
          button.addEventListener('click', function(event) {

            // Lấy dữ liệu của hàng được chọn
            var report = event.target.closest('tr').querySelector('td:nth-child(6)').textContent;
            var comment = event.target.closest('tr').querySelector('td:nth-child(5)').textContent;

            
            // Điền dữ liệu vào modal
            document.getElementById("inputReport").value = report;
            document.getElementById("inputComment").value = comment;
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