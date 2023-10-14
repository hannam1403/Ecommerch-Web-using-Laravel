@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <form class="form-inline d-flex mb-2" action="/DetailConfirmOrders" method="GET">
        <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 15%">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
        <div class="row">  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <a class="link-secondary" href="/DetailConfirmOrders" style="text-decoration: none">
                  <h4 class="card-title">Orders</h4>                
                </a>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="/DetailNewOrders">
                      Chưa xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="confirmorders-tab" data-bs-toggle="tab" href="#confirmorders" role="tab" aria-controls="confirmorders">
                      Đã xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="predeliveryorders-tab" href="/DetailPreDeliveryOrders">
                      Đang giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="deliveryordersuccess-tab" href="/DetailDoneOrders">  
                      Đã giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="abortorders-tab" href="/DetailAbortOrders">
                      Đơn hủy
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="deliveryordernotsuccess-tab" href="/DetailNotSuccessOrders">
                      Đơn giao không thành công
                    </a>
                  </li>
                </ul>
                <div class="tab-content py-0 px-0">
                    <div class="table-responsive tab-pane fade show active" id="confirmorders" role="tabpanel" aria-labelledby="confirmorders-tab">
                      <table class="table table-hover text-center">
                        <thead>
                          <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Giá thành</th>
                            <th>Số lượng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          @foreach($confirmOrders as $confirmOrder) 
                                <tr class="order-row" data-order-id="{{ $confirmOrder->ID }}">
                                  <td hidden>{{ $confirmOrder->ID }}</td>
                                  <td>{{ $confirmOrder->ProductName }}</td>
                                  <td>{{ $confirmOrder->CusName }}</td>
                                  <td>{{ $confirmOrder->Address }}</td>
                                  <td>{{ $confirmOrder->Time }}</td>
                                  <td>{{ $confirmOrder->Price }}</td>
                                  <td>{{ $confirmOrder->Quantity }}</td>
                                  <td>{{ $confirmOrder->PaymentMethod }}</td>
                                  <td >
                                    <a href="/DetailConfirmOrders/PreDelivery/{{$confirmOrder->ID}}">
                                      <button class="btn-edit btn btn-primary btn-rounded">Đã giao hàng cho Shipper</button>
                                    </a>                                            
                                  </td>
                                </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="pagination justify-content-center">
                        {{ $confirmOrders->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
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