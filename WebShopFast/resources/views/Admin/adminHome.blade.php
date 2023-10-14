<style>
    @keyframes fadeIn {
      0% {opacity: 0;}
      100% {opacity: 1;} 
   } 
  
  .header-notification{
      position: relative;
      display: inline-block;
      cursor: pointer;
      width: 50px;
      right: 88%;
  }
  
  .header-notification:hover .notification-hover {
      display: block;
  }
  
  .notification-icon-wrap{
      position: relative;
      display: inline-block;
      width: 35px;
  }
  
  .notification-icon-wrap-notice{
      position: absolute;
      background-color: orange;
      bottom: 20px;
      padding: 2px 7px;
      right: -10px;
      font-size: 1.0rem;
      line-height: 1.1rem;
      border-radius: 50px;
  }
  
  .notification-icon{
      height: 35px;
      margin-left: 6px;
      width: 10px;
  }
  
  .notification-hover{
      width: 500px;
      box-shadow: 0 1px 3.125rem 0 rgba(0,0,0,0.1);
      z-index: 8;
      margin-top: 55px;
      margin-right: 10px;
      display: none;
      background-color: white;
      align-items: center;
      border-radius: 2px;
      animation: fadeIn ease-in 0.3s;
      cursor: default;
  }
  
  .notification-hover::after{
      content: "";
      position: absolute;
      right: 461px;
      top: -33px;
      border-width: 17px 20px;
      border-style: solid;
      border-color: transparent transparent lightgray transparent;
  }
  
  .img-no-notification{
      width: 80%;
      height: 90%; 
      cursor: default;
      display: none;
  }
  
  .notification-hover-product-heading{
      margin: 12px;
      text-align: left;
      font-size: 1.4rem;
      color: #999;
      font-weight: 40;
  }
  
  .notification-hover-list-product{
      padding-left: 0;
      list-style: none;
  }
  
  .notification-hover-product{
      display: flex;
      border-bottom: 0.1px solid rgb(219, 216, 216);
  }
  
  .notification-hover-img{
      width: 60px;
      height: 60px;
      margin: 6px;
      border: 1px solid black;
  }
  
  .notification-hover-list-product{
      cursor: default;
      overflow-y: scroll;
      height: 220px;
  }
  
  .notification-hover-product:hover{
      background-color: rgb(240, 236, 236);
  }
  
  .notification-hover-product-info{
      width: 100%;
      align-items: center;
  }
  
  .notification-hover-product-head{
      display: flex;
      align-items: center;
      justify-content: space-between;
  }
  
  .notification-hover-product-name{
      font-size: 1.0rem;
      font-weight: 500;
      color: black;
      margin: 0;
  }
  
  .notification-hover-product-price{
      font-size: 1.4rem;
      font-weight: 400;
      color: red;
  }
  
  .notification-hover-product-multiply{
      font-size: 0.9rem;
      margin: 0 4px;
      color: #757575;
  }
  
  .notification-hover-product-quantity{
      color: #757575;
      font-size: 1.2rem;
  }
  .notification-hover-delbtn{
      margin-left: 83%;
  }
  </style>

@extends('Admin.Layouts.layoutManager')
@section('content')
  <!-- Main Content -->
  <script src="{{ asset('js/chart/Chart.js') }}"></script>
  <div id="content" class="col">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Topbar Search -->
        {{-- <form action="#" method="PUT">
            <div class="input-group pt-3 ps-3">
              <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
              <label for="var_search">
                <button type="submit" class="btn btn-outline-primary">Search</button>
              </label>
            </div>
          </form> --}}

          
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <div class="header-notification d-flex float-start ps-4">
                <div class="notification-icon-wrap">
                  <a class="notification-icon-wrap" href="/Notification">
                    <i class="notification-icon fa fa-bell pe-5 fa-2x pt-1" style="color: blue " aria-hidden="true"></i>
                  </a>
                  <?php 
                    $data = DB::selectOne('call getCountActiveNotification()')->Count;
                  ?>
                  <span class="notification-icon-wrap-notice" name="QuantityProduct">{{ $data }}</span>
                </div>
                <div class="notification-hover position-absolute">
                  <h4 class="notification-hover-product-heading">Notices</h4>
                  <ul class="notification-container notification-hover-list-product">
                    <?php 
                      $notices =  DB::table('notification')
                                    ->select('notification.IdAboutMember as IdAboutMember', 'notification.Content as Content', 'member.Name as Name')
                                    ->join('member', 'notification.IdAboutMember', '=', 'member.Id')
                                    ->where('notification.Status', '=', 1)
                                    ->get();
                      foreach ($notices as $notice) {
                    ?>    
                      <li class="notification-items notification-hover-product d-flex align-items-center p-2">
                        <div class="notification-hover-product-info">
                          <div class="notification-hover-product-head pe-3">
                            <h5 class="notification-hover-product-name"><b>Nội dung: </b>{{$notice->Content}}</h5>
                          </div>
                          <div>
                            <h5 class="notification-hover-product-name"><b>Tài khoản có Id: </b>{{ $notice->IdAboutMember }}</h5>
                          </div>
                          <div>
                            <h5 class="notification-hover-product-name"><b>Tên người dùng: </b>{{ $notice->Name }}</h5>
                          </div>
                        </div>
                      </li>    
                    <?php 
                    } 
                    ?>     
                  </ul>
                </div>
              </div>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Doanh Thu Tháng
                                    </div>
                                    <?php 
                                        $totalBalance = DB::select("call getTotalMonthWebIncome")[0]->Total;
                                    ?>
                                    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user[0]->AccountBalance}}</div> --}}
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="doanhthu" value={{$totalBalance}}>{{$totalBalance}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Tổng người dùng
                                    </div>
                                    <?php 
                                        $TotalUser = DB::select("SELECT COUNT(member.Id) as Count FROM member where member.RoleID != 1")[0]->Count;
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$TotalUser}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Giao Dịch Tháng
                                    </div>
                                    <?php 
                                        $product = DB::select("call getTotalMonthProductSold")[0]->Count;
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$product}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 15px; margin-bottom: 15px;">
                {{-- Bài đăng tháng --}}
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Bài đăng tháng
                                    </div>
                                    <?php 
                                        $productupload = DB::select("call getTotalMonthProductUpload")[0]->Count;
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$productupload}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-upload fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Rating Tháng
                                    </div>
                                    <?php 
                                        $star = DB::select('call getTotalMonthRating')[0]->Count;
                                    ?>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $star }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-star fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Comment Tháng
                                    </div>
                                    <?php 
                                        $TotalComment = DB::select("call getTotalMonthComment")[0]->Count;
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$TotalComment}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Doanh thu theo tháng</h6>
                    </div>
                    <div class="row" style="padding: 15px;">
                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" >Từ Tháng</span>
                                    </div>
                                    <input type="month" class="form-control" id="InputFromMonth">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" >Đến Tháng</span>
                                    </div>
                                    <input type="month" class="form-control" id="InputToMonth">
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary" style="width: 100%" id="btnSearchMonthlyRevenue">Tìm kiếm</button>
                            </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div style=" position: relative; height: 15rem; width: 100%;">
                            <canvas id="ChartMonthRevenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>   

        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Doanh thu theo ngày</h6>
                    </div>
                    <div class="row" style="padding: 15px;">
                            <!-- Card Header -->
                            
                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" >Từ Ngày</span>
                                    </div>
                                    <input type="date" class="form-control" id="InputFromDate">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" >Đến Ngày</span>
                                    </div>
                                    <input type="date" class="form-control" id="InputToDate">
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary" style="width: 100%" id="btnSearchDayRevenue">Tìm kiếm</button>
                            </div>
                    </div>                  
                    <!-- Card Body -->
                    <div class="card-body">
                        <div style=" position: relative; height: 15rem; width: 100%;">
                            <canvas id="ChartDayRevenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header-->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thống Kê Trạng Thái Đơn Hàng</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div style=" position: relative; height: 18rem; width: 100%;">
                            <canvas id="myPieChartStatusBill"></canvas>  
                        </div>                      
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-8 mb-4">
                <!-- Project Card Example -->             
                <div class="card shadow mb-4">
                     <!-- Card Header-->
                     <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thống Kê Sản Phẩm Đã Bán Theo Ngày</h6>
                    </div>
                    <div class="row" style="padding: 15px;">
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" >Từ Ngày</span>
                                </div>
                                <input type="date" class="form-control" id="InputFromDateTotalProduct">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" >Đến Ngày</span>
                                </div>
                                <input type="date" class="form-control" id="InputToDateTotalProduct">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary" style="width: 100%" id="btnSearchDayProduct">Tìm kiếm</button>
                        </div>
                    </div>
                   
                    <!-- Card Body -->
                    <div class="card-body">
                        <div style=" position: relative; height: 18rem; width: 100%;">
                            <canvas id="myChartAmountProductSold"></canvas>  
                        </div>                      
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header-->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Top Sản Phẩm Hot</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div style=" position: relative; height: 20rem; width: 100%;">
                            <canvas id="myPieChartTopProduct"></canvas>  
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="shop-id" style="display: none;"></div>
<script>
    var productsPrice = document.querySelector('#doanhthu');
    var price = parseInt(productsPrice.getAttribute('value')); 
    price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    productsPrice.innerText = price;

    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    var listDate = new Array();
    var listRevenue = new Array();
    
    var ctx = document.getElementById("ChartDayRevenue");    
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {         
            labels: listDate,
            datasets: [{
                label: "Doanh Thu",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: listRevenue,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return  number_format(value) + 'VND';
                }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
                display: false
            },
            tooltips: {             
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' VND';
                    }
                }
            }
        }
    });

    function GetDataChartDayRevenueAdmin(InputFromDateValue, InputToDateValue) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listDate = [];
                    listRevenue = [];
                    response.GetDataChartDayRevenueAdmin.forEach((item) => {
                        listDate.push(item.Date);
                        listRevenue.push(item.TotalPrice);
                    });
                    myLineChart.data.labels = listDate;
                    myLineChart.data.datasets[0].data = listRevenue;
                    myLineChart.update();
                } 
                else {
                    // Xử lý logic khi lỗi             
                }
            }
        };
        xhr.open('POST', '/GetDataChartDayRevenueAdmin');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            FromDate: InputFromDateValue,
            ToDate: InputToDateValue
        };
        xhr.send(JSON.stringify(data));   
    }          

    var btnSearchDayRevenue = document.querySelector('#btnSearchDayRevenue');     
    var InputFromDate = document.querySelector('#InputFromDate');  
    var InputToDate = document.querySelector('#InputToDate');  

    const today = new Date();
    const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

    // Chuyển đổi đối tượng Date thành chuỗi có định dạng chuẩn yyyy-mm-dd
    const yyyy = firstDayOfMonth.getFullYear();
    const mm = String(firstDayOfMonth.getMonth() + 1).padStart(2, '0');
    const dd = String(firstDayOfMonth.getDate()).padStart(2, '0');
    const fromDate = `${yyyy}-${mm}-${dd}`;

    const yyyy2 = lastDayOfMonth.getFullYear();
    const mm2 = String(lastDayOfMonth.getMonth() + 1).padStart(2, '0');
    const dd2 = String(lastDayOfMonth.getDate()).padStart(2, '0');
    const toDate = `${yyyy2}-${mm2}-${dd2}`;
    // Gán giá trị cho thuộc tính value của input
    InputFromDate.value = fromDate;
    InputToDate.value = toDate;
    GetDataChartDayRevenueAdmin(fromDate, toDate);

    btnSearchDayRevenue.addEventListener('click', function(e) { 
        var InputFromDate = document.querySelector('#InputFromDate');  
        var InputToDate = document.querySelector('#InputToDate');  
        GetDataChartDayRevenueAdmin(InputFromDate.value, InputToDate.value);   
    });

    var ctx2 = document.getElementById("ChartMonthRevenue");   
    var myLineChartMonthRevenue = new Chart(ctx2, {
        type: 'line',
        data: {         
            labels: listDate,
            datasets: [{
                label: "Doanh Thu",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: listRevenue,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return  number_format(value) + 'VND';
                }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
                display: false
            },
            tooltips: {             
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' VND';
                    }
                }
            }
        }
    });

    function GetDataChartMonthRevenueAdmin(Year, FromMonth, ToMonth) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listDate = [];
                    listRevenue = [];
                    response.GetDataChartMonthRevenueAdmin.forEach((item) => {
                        listDate.push(item.Date);
                        listRevenue.push(item.TotalPrice);
                    });
                    myLineChartMonthRevenue.data.labels = listDate;
                    myLineChartMonthRevenue.data.datasets[0].data = listRevenue;
                    myLineChartMonthRevenue.update();
                } 
                else {
                    // Xử lý logic khi lỗi             
                }
            }
        };
        xhr.open('POST', '/GetDataChartMonthRevenueAdmin');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            Year: Year,
            FromMonth: FromMonth,
            ToMonth: ToMonth
        };
        xhr.send(JSON.stringify(data));   
    }          


    var btnSearchMonthlyRevenue = document.querySelector('#btnSearchMonthlyRevenue');     
    var InputFromMonth = document.querySelector('#InputFromMonth'); 
    var InputToMonth = document.querySelector('#InputToMonth');  

    // Chuyển đổi đối tượng Date thành chuỗi có định dạng chuẩn yyyy-mm-dd
    const now = new Date(); // Lấy thời điểm hiện tại
    const year = now.getFullYear(); // Lấy năm hiện tại
    const fromMonth = `${year}-01`; // Định dạng chuỗi tháng đầu tiên dạng 'mm-yyyy'
    const toMonth = `${year}-12`; // Định dạng chuỗi tháng cuối cùng dạng 'mm-yyyy'
    // Gán giá trị cho thuộc tính value của input
    InputFromMonth.value = fromMonth;
    InputToMonth.value = toMonth;
    GetDataChartMonthRevenueAdmin(year, 1, 12);

    btnSearchMonthlyRevenue.addEventListener('click', function(e) { 
        var InputFromMonth = document.querySelector('#InputFromMonth');  
        var InputToMonth = document.querySelector('#InputToMonth'); 
        var now = new Date(); 
        var year = now.getFullYear();
        var FromMonth = InputFromMonth.value.split('-')[1];
        var ToMonth = InputToMonth.value.split('-')[1];
        GetDataChartMonthRevenueAdmin(year, FromMonth, ToMonth);  
    });

    var listStatus = new Array();
    var listCount = new Array();
    var ctx3 = document.getElementById("myPieChartStatusBill");   
    var myPieChart = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: listStatus,
            datasets: [{
                data: listCount,
                backgroundColor: ['#f6c23e', '#1cc88a', '#36b9cc', "#4e73df", "#e74a3b"],
                hoverBackgroundColor: ['#f6c23e', '#1cc88a', '#36b9cc', "#4e73df", "#e74a3b"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 80,
        },
    });  

    function GetDataChartStatusBillAdmin() {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listStatus = [];
                    listCount = [];
                    response.GetDataChartStatusBillAdmin.forEach((item) => {
                        listStatus.push(item.Name);
                        listCount.push(item.Count);
                    });
                    myPieChart.data.labels = listStatus;
                    myPieChart.data.datasets[0].data = listCount;
                    myPieChart.update();
                } 
                else {
                    // Xử lý logic khi lỗi             
                }
            }
        };
        xhr.open('POST', '/GetDataChartStatusBillAdmin');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
        };
        xhr.send(JSON.stringify(data));   
    }      
    GetDataChartStatusBillAdmin();    

    var listToTal= new Array();
    var listProduct = new Array();

    var ctx4 = document.getElementById("myChartAmountProductSold");   
    var myChartAmountProductSold = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: listProduct, 
            datasets: [{
                label: 'Số Sản Phẩm',
                data: listToTal,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });  

    function GetDataChartDayProductAdmin(fromDate, toDate) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listProduct= [];
                    listTotal = [];
                    response.GetDataChartDayProductAdmin.forEach((item) => {
                        listProduct.push(item.Name);
                        listTotal.push(item.ToTalProduct);
                    });
                    myChartAmountProductSold.data.labels = listProduct;
                    myChartAmountProductSold.data.datasets[0].data = listTotal;
                    myChartAmountProductSold.update();
                } 
                else {
                    // Xử lý logic khi lỗi             
                }
            }
        };
        xhr.open('POST', '/GetDataChartDayProductAdmin');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            FromDate: fromDate,
            ToDate: toDate
        };
        xhr.send(JSON.stringify(data));   
    }      

    var btnSearchDayProduct = document.querySelector('#btnSearchDayProduct');     
    var InputFromDateTotalProduct = document.querySelector('#InputFromDateTotalProduct');  
    var InputToDateTotalProduct = document.querySelector('#InputToDateTotalProduct');  

    var todayTotalProduct = new Date();
    var firstDayOfMonthTotalProduct = new Date(today.getFullYear(), today.getMonth(), 1);
    var lastDayOfMonthTotalProduct = new Date(today.getFullYear(), today.getMonth() + 1, 0);

    // Chuyển đổi đối tượng Date thành chuỗi có định dạng chuẩn yyyy-mm-dd
    var yyyyTotalProduct = firstDayOfMonthTotalProduct.getFullYear();
    var mmTotalProduct = String(firstDayOfMonthTotalProduct.getMonth() + 1).padStart(2, '0');
    var ddTotalProduct = String(firstDayOfMonthTotalProduct.getDate()).padStart(2, '0');
    var fromDateTotalProduct = `${yyyyTotalProduct}-${mmTotalProduct}-${ddTotalProduct}`;

    var yyyy2TotalProduct = lastDayOfMonthTotalProduct.getFullYear();
    var mm2TotalProduct = String(lastDayOfMonthTotalProduct.getMonth() + 1).padStart(2, '0');
    var dd2TotalProduct = String(lastDayOfMonthTotalProduct.getDate()).padStart(2, '0');
    var toDateTotalProduct = `${yyyy2TotalProduct}-${mm2TotalProduct}-${dd2TotalProduct}`;
    // Gán giá trị cho thuộc tính value của input
    InputFromDateTotalProduct.value = fromDateTotalProduct;
    InputToDateTotalProduct.value = toDateTotalProduct;
    GetDataChartDayProductAdmin(fromDateTotalProduct, toDateTotalProduct);

    btnSearchDayProduct.addEventListener('click', function(e) { 
        var InputFromDateTotalProduct = document.querySelector('#InputFromDateTotalProduct');  
        var InputToDateTotalProduct = document.querySelector('#InputToDateTotalProduct');  
        GetDataChartDayProductAdmin(InputFromDateTotalProduct.value, InputToDateTotalProduct.value);   
    });


    /////////////////////////////////////
    var listProduct = new Array();
    var listCountProduct = new Array();
    var ctx5 = document.getElementById("myPieChartTopProduct");   
    var myPieChartTopProduct = new Chart(ctx5, {
        type: 'doughnut',
        data: {
            labels: listProduct,
            datasets: [{
                data: listCountProduct,
                backgroundColor: ['#f6c23e', '#1cc88a', '#36b9cc', "#4e73df", "#e74a3b"],
                hoverBackgroundColor: ['#f6c23e', '#1cc88a', '#36b9cc', "#4e73df", "#e74a3b"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 80,
        },
    });  

    function GetDataChartTopProductAdmin() {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    console.log(response);
                    listProduct = [];
                    listCountProduct = [];
                    response.GetDataChartTopProductAdmin.forEach((item) => {
                        listProduct.push(item.Name);
                        listCountProduct.push(item.TotalQuantity);
                    });
                    myPieChartTopProduct.data.labels = listProduct;
                    myPieChartTopProduct.data.datasets[0].data = listCountProduct;
                    myPieChartTopProduct.update();
                } 
                else {
                    // Xử lý logic khi lỗi             
                }
            }
        };
        xhr.open('POST', '/GetDataChartTopProductAdmin');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
        };
        xhr.send(JSON.stringify(data));   
    }      
    GetDataChartTopProductAdmin();    
</script>
@endsection