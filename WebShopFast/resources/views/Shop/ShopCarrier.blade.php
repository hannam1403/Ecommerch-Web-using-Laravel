@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <form class="form-inline d-flex mb-2" action="/ShopCarrier" method="GET">
      <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 15%">
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
  <section>
      <div class="row">     
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <a class="link-secondary" href="/ShopCarrier" style="text-decoration: none">
                <h4 class="card-title">CHỌN ĐƠN VỊ VẬN CHUYỂN</h4>
              </a>
              <div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Địa chỉ giao hàng</th>
                      <th>Tên sản phẩm</th>
                      <th>Giá cả</th>
                      <th>Số lượng</th>
                      <th>Thời gian lập đơn hàng</th>
                      <th>Chọn đơn vị giao hàng</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach($carriers as $carrier) 
                    <tr>
                      <td>{{ $carrier->Id }}</td>
                      <td>{{ $carrier->Address }}</td>
                      <td>{{ $carrier->ProductName }}</td>
                      <td>{{ $carrier->Price}}</td>
                      <td>{{ $carrier->Quantity}}</td>
                      <td>{{ $carrier->Time }}</td>
                      <td>
                        <form method="POST" action="{{ route('ChangeCarrier', $carrier->Id) }}">
                          @csrf
                          <select name="option">
                            @foreach ($options as $option)
                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                          </select>
                          <button class="btn btn-sm btn-primary btn-rounded" type="submit" name="submit">Submit</button>  
                        </form>
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
    {{ $carriers->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
  </div>
@endsection

