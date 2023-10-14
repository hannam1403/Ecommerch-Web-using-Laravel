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
            <form method="POST" action="{{ url('/MarketingProductManager/Delete') }}">
              @csrf
              <button type="submit" class="btn btn-danger mt-2 mt-xl-0">Xóa các sản phẩm đã quá hạn sử dụng</button>
            </form>
          </div>
          <div class="col-lg-12 grid-margin stretch-card"><br>
            <form action="/MarketingProductManager/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Tìm sản phẩm theo mã sản phẩm" aria-label="Search" aria-describedby="search-addon" />
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
                <h4 class="card-title">Các sản phẩm áp dụng Marketing</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Mã sản phẩm</th>
                        <th>Loại Marketing</th>
                        <th>Ngày áp dụng</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($marketingproductsmanager as $marketingproductmanager) 
                      <tr>
                        <td hidden>{{ $marketingproductmanager->Id }}</td>
                        <td>{{ $marketingproductmanager->ProductId }}</td>
                        <td>{{ $marketingproductmanager->MarketingName }}</td>
                        <td>{{ $marketingproductmanager->Time }}</td>
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
      {{ $marketingproductsmanager->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>
@endsection