@extends('Admin.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <form action="/DeletedCarrierManager/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Tìm đơn vị vận chuyển theo tên" aria-label="Search" aria-describedby="search-addon" />
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
                <h4 class="card-title">Thông tin đơn vị vận chuyển</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Carrier Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($deletedcarriers as $deletedcarrier) 
                      <tr>
                        <td hidden>{{ $deletedcarrier->id }}</td>
                        <td>{{ $deletedcarrier->name }}</td>
                        <td>{{ $deletedcarrier->address }}</td>
                        <td>{{ $deletedcarrier->phone }}</td>
                        <td>{{ $deletedcarrier->email }}</td>
                        <td>                    
                          <a href="/DeletedCarrierManager/Active/{{$deletedcarrier->id}}">
                            <button class=" btn btn-rounded btn-primary btn-fw mt-2 mt-xl-0">Active</button>
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
      {{ $deletedcarriers->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>
@endsection