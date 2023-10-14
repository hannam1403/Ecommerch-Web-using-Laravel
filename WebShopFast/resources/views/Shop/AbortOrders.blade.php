@extends('Shop.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <form class="form-inline d-flex mb-2" action="/DetailAbortOrders" method="GET">
        <input id="search" class="form-control rounded me-1" type="text" name="search" placeholder="Search by name..." aria-label="Search" aria-describedby="search-addon" style="width: 15%">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
        <div class="row">  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <a class="link-secondary" href="/DetailAbortOrders" style="text-decoration: none">
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
                    <a class="nav-link" id="deliveryordersuccess-tab"  href="/DetailDoneOrders">
                      Đã giao
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="abortorders-tab" href="#abortorders" data-bs-toggle="tab" role="tab" aria-controls="abortorders" aria-selected="false">
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
                                </tr>                          
                          @endforeach
                        </tbody>
                      </table>
                      <div class="pagination justify-content-center">
                        {{ $abortOrders->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
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
@endsection