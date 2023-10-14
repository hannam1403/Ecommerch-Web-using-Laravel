@extends('layouts.app')
@section('content')
<div class="col py-3 main-panel" style="align-items: center; justify-content: center; display: flex">
    <section class="col-9" style="display: inline-block;">
        <div class="row">  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Orders</h4>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="neworders-tab" data-bs-toggle="tab" href="#neworders" role="tab" aria-controls="neworders" aria-selected="true">
                      Chưa xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="confirmorders-tab" data-bs-toggle="tab" href="#confirmorders" role="tab" aria-controls="confirmorders" aria-selected="false">
                      Đã xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="predeliveryorders-tab" data-bs-toggle="tab" href="#predeliveryorders" role="tab" aria-controls="predeliveryorders" aria-selected="false">
                      Đang giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="deliveryordersuccess-tab" data-bs-toggle="tab" href="#deliveryordersuccess" role="tab" aria-controls="deliveryordersuccess" aria-selected="false">  
                      Đã giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="abortorders-tab" data-bs-toggle="tab" href="#abortorders" role="tab" aria-controls="abortorders" aria-selected="false">
                      Đơn hủy
                    </a>
                  </li>
                </ul>
                <div class="tab-content py-0 px-0">
                  <div class="table-responsive tab-pane fade show active text-center" id="neworders" role="tabpanel" aria-labelledby="neworders-tab">
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
                        @if (!empty($orders)) 
                          @foreach($orders as $order) 
                                <tr class="order-row" data-order-id="{{ $order->ID }}">
                                  <td hidden>{{ $order->ID }}</td>
                                  <td>{{ $order->ProductName }}</td>
                                  <td>{{ $order->CusName }}</td>
                                  <td>{{ $order->Address }}</td>
                                  <td>{{ $order->Time }}</td>
                                  <td>{{ $order->Price }}</td>
                                  <td>{{ $order->Quantity }}</td>
                                  <td>{{ $order->PaymentMethod }}</td>
                                  <td >       
                                    <a href="/DetailNewOrders/Abort/{{$order->ID}}">
                                      <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Hủy đơn</button>
                                    </a>                       
                                  </td>
                                </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="confirmorders" role="tabpanel" aria-labelledby="confirmorders-tab">
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
                          @if (!empty($confirmOrders)) 
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
                                      <a href="/DetailNewOrders/Abort/{{$confirmOrder->ID}}">
                                          <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Hủy đơn</button>
                                      </a>                                            
                                    </td>
                                  </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="predeliveryorders" role="tabpanel" aria-labelledby="predeliveryorders-tab">
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
                            <th>Phương thức thanh toán</th>
                          </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($preDeliveryOrders)) 
                            @foreach($preDeliveryOrders as $preDeliveryOrder) 
                                  <tr class="order-row" data-order-id="{{ $preDeliveryOrder->ID }}">
                                    <td hidden>{{ $preDeliveryOrder->ID }}</td>
                                    <td>{{ $preDeliveryOrder->ProductName }}</td>
                                    <td>{{ $preDeliveryOrder->CusName }}</td>
                                    <td>{{ $preDeliveryOrder->Address }}</td>
                                    <td>{{ $preDeliveryOrder->Time }}</td>
                                    <td>{{ $preDeliveryOrder->Price }}</td>
                                    <td>{{ $preDeliveryOrder->Quantity }}</td>
                                    <td>{{ $preDeliveryOrder->PaymentMethod }}</td>
                                  </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="deliveryordersuccess" role="tabpanel" aria-labelledby="deliveryordersuccess-tab">
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
                          </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($deliveryOrdersSuccess)) 
                            @foreach($deliveryOrdersSuccess as $deliveryOrderSuccess) 
                                  <tr class="order-row" data-order-id="{{ $deliveryOrderSuccess->ID }}">
                                    <td hidden>{{ $deliveryOrderSuccess->ID }}</td>
                                    <td>{{ $deliveryOrderSuccess->ProductName }}</td>
                                    <td>{{ $deliveryOrderSuccess->CusName }}</td>
                                    <td>{{ $deliveryOrderSuccess->Address }}</td>
                                    <td>{{ $deliveryOrderSuccess->Time }}</td>
                                    <td>{{ $deliveryOrderSuccess->Price }}</td>
                                    <td>{{ $deliveryOrderSuccess->Quantity }}</td>
                                  </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="abortorders" role="tabpanel" aria-labelledby="abortorders-tab">
                    <div class="table-responsive tab-pane fade show active" id="abortorders" role="tabpanel" aria-labelledby="abortorders-tab">
                      <table class="table table-hover text-center">
                        <thead>
                          <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Giá thành</th>
                            <th>Số lượng</th>
                          </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($abortOrders)) 
                            @foreach($abortOrders as $abortOrder) 
                                  <tr class="order-row" data-order-id="{{ $abortOrder->ID }}">
                                    <td hidden>{{ $abortOrder->ID }}</td>
                                    <td>{{ $abortOrder->ProductName }}</td>
                                    <td>{{ $abortOrder->CusName }}</td>
                                    <td>{{ $abortOrder->Address }}</td>
                                    <td>{{ $abortOrder->Time }}</td>
                                    <td>{{ $abortOrder->Price }}</td>
                                    <td>{{ $abortOrder->Quantity }}</td>
                                  </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
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