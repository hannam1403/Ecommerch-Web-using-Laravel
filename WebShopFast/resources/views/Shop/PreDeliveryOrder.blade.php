@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <form class="form-inline d-flex mb-2" action="/DetailPreDeliveryOrders" method="GET">
        <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 15%">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
        <div class="row">  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <a class="link-secondary" href="/DetailPreDeliveryOrders" style="text-decoration: none">
                  <h4 class="card-title">Orders</h4>                
                </a>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="/DetailNewOrders">
                      Chưa xác nhận
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" id="confirmorders-tab"  href="/DetailConfirmOrders">
                      Đã xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="predeliveryorders-tab" href="#predeliveryorders" data-bs-toggle="tab" role="tab" aria-controls="predeliveryorders" aria-selected="false">
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
                        <div class="table-responsive tab-pane fade show active" id="predeliveryorders" role="tabpanel" aria-labelledby="predeliveryorders-tab">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Tên khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Giá thành</th>
                                    <th>Số lượng</th>
                                    <th>Thanh toán</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody> 
                                @foreach($preDeliveryOrders as $preDeliveryOrder) 
                                        <tr class="order-row" data-order-id="{{ $preDeliveryOrder->ID }}">
                                        <td name="IDabort" hidden>{{ $preDeliveryOrder->ID }}</td>
                                        <td>{{ $preDeliveryOrder->ProductName }}</td>
                                        <td>{{ $preDeliveryOrder->CusName }}</td>
                                        <td>{{ $preDeliveryOrder->Address }}</td>
                                        <td>{{ $preDeliveryOrder->Time }}</td>
                                        <td>{{ $preDeliveryOrder->Price }}</td>
                                        <td>{{ $preDeliveryOrder->Quantity }}</td>
                                        <td>{{ $preDeliveryOrder->PaymentMethod }}</td>
                                        <td>
                                            <a href="/DetailPreDeliveryOrders/Success/{{$preDeliveryOrder->ID}}">
                                                <button class="btn-edit btn btn-primary btn-rounded">Giao hàng thành công</button>                       
                                            </a>      
                                            <button id="{{ $preDeliveryOrder->ID }}" class="btn-edit btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#modalReasonAbort">
                                            Giao hàng thất bại
                                            </button>   
                                        </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center">
                                {{ $preDeliveryOrders->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>

@include('Shop.ReasonAbort')

@endsection