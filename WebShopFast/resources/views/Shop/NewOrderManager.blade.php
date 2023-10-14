@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <form class="form-inline d-flex mb-2" action="/DetailNewOrders" method="GET">
        <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 15%">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
        <div class="row">  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <a class="link-secondary" href="/DetailNewOrders" style="text-decoration: none">
                  <h4 class="card-title">Orders</h4>
                </a>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="neworders-tab" data-bs-toggle="tab" href="#neworders" role="tab" aria-controls="neworders" aria-selected="true">
                      Chưa xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="confirmorders-tab" href="/DetailConfirmOrders"> {{-- data-bs-toggle="tab" role="tab"aria-controls="confirmorders"aria-selected="false"> --}}
                      Đã xác nhận
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="predeliveryorders-tab" href="/DetailPreDeliveryOrders"> {{-- data-bs-toggle="tab" role="tab" aria-controls="predeliveryorders" aria-selected="false"> --}}
                      Đang giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="deliveryordersuccess-tab"  href="/DetailDoneOrders"> {{-- data-bs-toggle="tab" role="tab" aria-controls="deliveryordersuccess" aria-selected="false">  --}} 
                      Đã giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="abortorders-tab" href="/DetailAbortOrders"> {{-- data-bs-toggle="tab" role="tab" aria-controls="abortorders" aria-selected="false"> --}}
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
                  <div class="table-responsive tab-pane fade show active" id="neworders" role="tabpanel" aria-labelledby="neworders-tab">
                    <table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th>Tên sản phẩm</th>
                          <th>Tên khách hàng</th>
                          <th>Địa chỉ</th>
                          <th>Thời gian đặt hàng</th>
                          <th>Giá thành</th>
                          <th>Số lượng</th>
                          <th>Kiểu thanh toán</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody> 
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
                                  {{-- <button class="btn btn-rounded btn-success" id="show-products-btn" data-order-id="{{ $order->ID }}">Chi tiết</button> --}}
                                  <a href="/DetailNewOrders/Approve/{{$order->ID}}">
                                    <button class="btn-edit btn btn-primary btn-rounded">Chấp nhận</button>              
                                  </a>         
                                  <a href="/DetailNewOrders/Abort/{{$order->ID}}" onclick="return confirmDelete(event)">
                                    <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Từ chối</button>
                                  </a>                       
                                </td>
                              </tr>
                              {{-- <div id="products-modal" class="modal">
                                <div class="modal-content" style="width: 50%">
                                    <span class="close"></span>
                                    <div id="products-table"></div>
                                </div>
                              </div> --}}
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                      {{ $orders->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
                    </div>
                  </div>
                  {{-- <div class="tab-pane fade" id="confirmorders" role="tabpanel" aria-labelledby="confirmorders-tab">
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
                                  <td >
                                    {{-- <button class="btn btn-rounded btn-success" id="show-products-btn" data-order-id="{{ $confirmOrder->ID }}">Chi tiết</button> 
                                    <a href="/DetailNewOrders/PreDelivery/{{-- $confirmOrder->ID ">
                                      <button class="btn-edit btn btn-primary btn-rounded">Đã giao hàng cho Shipper</button>
                                    </a>                                            
                                  </td>
                                </tr>
                                {{-- <div id="products-modal" class="modal">
                                  <div class="modal-content" style="width: 50%">
                                      <span class="close"></span>
                                      <div id="products-table"></div>
                                  </div>
                                </div> 
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>--}} 
                  {{-- <div class="tab-pane fade" id="predeliveryorders" role="tabpanel" aria-labelledby="predeliveryorders-tab">
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
                                  <td >
                                    {{-- <button class="btn btn-rounded btn-success" id="show-products-btn" data-order-id="{{ $preDeliveryOrder->ID }}">Chi tiết</button> 
                                    <a href="/DetailNewOrders/DeliverySuccess/{{$preDeliveryOrder->ID}}">
                                      <button class="btn-edit btn btn-primary btn-rounded">Đã giao hàng thành công</button>                       
                                    </a>      
                                    <button id="{{ $preDeliveryOrder->ID }}" class="btn-edit btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalReasonAbort">
                                      Đơn hàng giao không thành công
                                    </button>   
                                  </td>
                                </tr>
                                {{-- <div id="products-modal" class="modal">
                                  <div class="modal-content" style="width: 50%">
                                      <span class="close"></span>
                                      <div id="products-table"></div>
                                  </div>
                                </div> 
                          @endforeach
                        </tbody>
                      </table>
                      <div class="pagination justify-content-center">
                        {{ $preDeliveryOrders->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
                      </div>
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
                          @foreach($deliveryOrdersSuccess as $deliveryOrderSuccess) 
                                <tr class="order-row" data-order-id="{{ $deliveryOrderSuccess->ID }}">
                                  <td hidden>{{ $deliveryOrderSuccess->ID }}</td>
                                  <td>{{ $deliveryOrderSuccess->ProductName }}</td>
                                  <td>{{ $deliveryOrderSuccess->CusName }}</td>
                                  <td>{{ $deliveryOrderSuccess->Address }}</td>
                                  <td>{{ $deliveryOrderSuccess->Time }}</td>
                                  <td>{{ $deliveryOrderSuccess->Price }}</td>
                                  <td>{{ $deliveryOrderSuccess->Quantity }}</td>
                                  {{-- <td >
                                    <button class="btn btn-rounded btn-success button1" id="show-products-btn" data-order-id="{{ $deliveryOrderSuccess->ID }}">Chi tiết</button>
                                  </td> 
                                </tr>
                                {{-- <div id="products-modal" class="modal">
                                  <div class="modal-content" style="width: 50%">
                                      <span class="close"></span>
                                      <div id="products-table"></div>
                                  </div>
                                </div> 
                          @endforeach
                        </tbody>
                      </table>
                      <div class="pagination justify-content-center">
                        {{ $deliveryOrdersSuccess->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
                      </div>
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
                          @foreach($abortOrders as $abortOrder) 
                                <tr class="order-row" data-order-id="{{ $abortOrder->ID }}">
                                  <td hidden>{{ $abortOrder->ID }}</td>
                                  <td>{{ $abortOrder->ProductName }}</td>
                                  <td>{{ $abortOrder->CusName }}</td>
                                  <td>{{ $abortOrder->Address }}</td>
                                  <td>{{ $abortOrder->Time }}</td>
                                  <td>{{ $abortOrder->Time }}</td>
                                  <td>{{ $abortOrder->Price }}</td>
                                  {{-- <td >
                                    <button class="btn btn-rounded btn-success" id="show-products-btn" data-order-id="{{ $abortOrder->ID }}">Chi tiết</button>   
                                  </td> 
                                </tr>
                                {{-- <div id="products-modal" class="modal">
                                  <div class="modal-content" style="width: 50%">
                                      <span class="close"></span>
                                      <div id="products-table"></div>
                                  </div>
                                </div> 
                          @endforeach
                        </tbody>
                      </table>
                      <div class="pagination justify-content-center">
                        {{ $abortOrders->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
                      </div>
                    </div>
                  </div>--}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>

<script>
  function confirmDelete(event) {
      if (!confirm("Bạn có chắc chắn muốn từ chối đơn hàng?")) {
          event.preventDefault();
          return false;
      }
      return true;
  }
</script>
{{-- @include('Shop.ReasonAbort') --}}

  {{-- <script>
    var modal = document.getElementById("products-modal");
    var btns = document.querySelectorAll(".btn-success[data-order-id]");
    var span = document.getElementsByClassName("close")[0];
    var table = document.getElementById("products-table");

    btns.forEach(function(btn) {
      btn.onclick = function() {
          var orderId = this.getAttribute("data-order-id");
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  table.innerHTML = this.responseText;
                  modal.style.display = "inline-block";
              }
          };
          xhr.open("GET", "/DetailNewOrders/" + orderId + "/DetailOrder", true);
          xhr.send();
      }
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
  </script> --}}
@endsection
{{-- <style>
  @keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
  }
  .modal {
    display: none;
    position: absolute;
    z-index: 1;
    width: 50%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    animation: fadeIn 0.4s;
    align-items: center;
}

.modal-content {
    position: absolute;
    background-color: #fefefe;
    margin-top: 10%;
    margin-left: 25%;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
}
</style> --}}