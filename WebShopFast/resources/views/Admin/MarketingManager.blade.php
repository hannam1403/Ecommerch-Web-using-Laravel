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
            <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalAddMarketing">
                Add Marketing Method
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card"> <br>
            <form action="/MarketingManager/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Tìm danh mục marketing theo tên" aria-label="Search" aria-describedby="search-addon" />
                <label for="var_search">
                  <button type="submit" class="btn btn-outline-primary">Search</button>
                </label>
              </div>
            </form>
          </div>   
          <br><br>      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Marketing Method</h4>
                <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th>Marketing Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody> 
                    @foreach($marketings as $marketing) 
                    <tr>
                        <td hidden>{{ $marketing->Id }}</td>
                        <td>{{ $marketing->Name }}</td>
                        <td>{{ $marketing->Price }}</td>
                        <td>
                        <button class="btn-edit btn btn-primary btn-rounded"
                            data-bs-toggle="modal" data-bs-target="#modalEditMarketing">Edit</button>                       
                        <a href="/MarketingManager/Delete/{{$marketing->Id}}" onclick="return confirmDelete(event)">
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
        {{ $marketings->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
      </div>
</div>

 <!-- Modal Add Marketing -->
 <div class="modal fade" id="modalAddMarketing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <form action="/MarketingManager/addMarketing" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Marketing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">    
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="Name">
                        </div>
                    </div> 
                    <div class="mb-3 row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputPrice" name="Price">
                        </div>
                    </div>         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Marketing-->
<div class="modal fade" id="modalEditMarketing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <form action="/MarketingManager/editMarketing" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Marketing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" hidden class="form-control" id="inputEditId" name="idmarketing">
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEditName" name="Name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputEditPrice" name="Price">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
        var id = event.target.closest('tr').querySelector('td:nth-child(1)').textContent;
        var name = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
        var price = event.target.closest('tr').querySelector('td:nth-child(3)').textContent;
        
        // Điền dữ liệu vào modal
        document.getElementById("inputEditId").value = id;
        document.getElementById("inputEditName").value = name;
        document.getElementById("inputEditPrice").value = price;
        });
    });
</script>

<script>
    function confirmDelete(event) {
        if (!confirm("Bạn có chắc chắn muốn xóa phương thức marketing này?")) {
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
@endsection