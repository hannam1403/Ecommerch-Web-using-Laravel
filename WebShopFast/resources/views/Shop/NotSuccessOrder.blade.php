@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
      <form class="form-inline d-flex mb-2" action="/DetailNotSuccessOrders" method="GET">
        <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 15%">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
        <div class="row">  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <a class="link-secondary" href="/DetailNotSuccessOrders" style="text-decoration: none">                
                  <h4 class="card-title">Orders</h4>
                </a>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" id="neworders-tab" href="/DetailNewOrders">
                      Chưa xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="confirmorders-tab" href="/DetailConfirmOrders">
                      Đã xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="predeliveryorders-tab" href="/DetailPreDeliveryOrders">
                      Đang giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="deliveryordersuccess-tab"  href="/DetailDoneOrders" >   
                      Đã giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="abortorders-tab" href="/DetailAbortOrders">
                      Đơn hủy
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="deliveryordernotsuccess-tab" href="/DetailNotSuccessOrders" data-bs-toggle="tab" role="tab" aria-controls="deliveryordernotsuccess" aria-selected="false">
                      Đơn giao không thành công
                    </a>
                  </li>
                </ul>
                  <div class="table-responsive tab-pane fade show active" id="deliveryordersuccess" role="tabpanel" aria-labelledby="deliveryordersuccess-tab">
                    <table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th>Tên sản phẩm</th>
                          <th>Tên khách hàng</th>
                          <th>Địa chỉ</th>
                          <th>Thời gian đặt hàng</th>
                          <th>Giá thành</th>
                          <th>Số lượng</th>
                          <th>Lí do hủy</th>
                        </tr>
                      </thead>
                      <tbody> 
                        @foreach($deliveryOrdersNotSuccess as $data) 
                              <tr class="order-row" data-order-id="{{ $data->ID }}">
                                <td hidden>{{ $data->ID }}</td>
                                <td>{{ $data->ProductName }}</td>
                                <td>{{ $data->CusName }}</td>
                                <td>{{ $data->Address }}</td>
                                <td>{{ $data->Time }}</td>
                                <td>{{ $data->Price }}</td>
                                <td>{{ $data->Quantity }}</td>
                                <td>{{ $data->Reason }}</td>
                              </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                      {{ $deliveryOrdersNotSuccess->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
@endsection