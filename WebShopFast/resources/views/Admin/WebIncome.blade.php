@extends('Admin.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">   
          <div class="col-lg-12 grid-margin stretch-card">
            <form action="/WebIncome/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Tìm kiếm doanh thu theo mã đơn hàng" aria-label="Search" aria-describedby="search-addon" />
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
                <h4 class="card-title">Doanh thu </h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Mã đơn hàng</th>
                        <th>Doanh thu nhận được từ đơn hàng</th>
                        <th>Ngày hoàn thành đơn hàng</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($webincomes as $webincome) 
                      <tr>
                        <td hidden>{{ $webincome->Id }}</td>
                        <td>{{ $webincome->IdBillDetail }}</td>
                        <td>{{ $webincome->Income }}</td>
                        <td>{{ $webincome->Create_at }}</td>
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
      {{ $webincomes->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>
@endsection