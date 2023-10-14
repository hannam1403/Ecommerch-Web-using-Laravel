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
            <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalAddBanner">
              Add Banner
            </button>
          </div> 
          <div class="col-lg-12 grid-margin stretch-card"><br>
            <form action="/BannerManager/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Tìm banner theo tên" aria-label="Search" aria-describedby="search-addon" />
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
                <h4 class="card-title">Basic Table</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Banner</th>
                        <th>Picture</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($banners as $banner) 
                      <tr>
                        <td hidden>{{ $banner->BannerId }}</td>
                        <td>{{ $banner->Name }}</td>
                        <td>
                          <img src="{{ asset('images/Banner/'.$banner->Picture) }}" style="width: 50%; height: 20%;">
                        </td>
                        <td>                     
                          <a href="/BannerManager/Delete/{{$banner->BannerId}}" onclick="return confirmDelete(event)">
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
      {{ $banners->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>
    @include('Admin.addBanner')

    <script>
      function confirmDelete(event) {
          if (!confirm("Bạn có chắc chắn muốn xóa banner này?")) {
              event.preventDefault();
              return false;
          }
          return true;
      }
  </script>
@endsection