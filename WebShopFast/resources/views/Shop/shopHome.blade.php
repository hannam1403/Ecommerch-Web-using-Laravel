@extends('Shop.Layouts.layoutManager')

@section('content')
  <!-- Main Content -->
  <script src="{{ asset('js/chart/Chart.js') }}"></script>
  <div id="content" class="col">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Topbar Search -->
        {{-- <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            style="padding-left: 20px; ">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form> --}}
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng Doanh Thu
                                </div>
                                <?php 
                                    // $user = DB::table('billdetail')
                                    //             ->select('select(SUM('billdetail.Price' * 95 / 100)) as Total')
                                    //             ->join('product', 'billdetail.IdProduct = product.Id')
                                    //             ->where('product.user_id', '=', Session::get('my_user_id'))
                                    //             ->where('billdetail.Status', '=', 4);
                                    $doanhthu = DB::select('select 0.95 * sum(billdetail.Price) as Total 
                                                        from billdetail 
                                                        join product 
                                                        on billdetail.IdProduct = product.Id
                                                        where billdetail.Status = 4 and product.user_id = :user_id',
                                                        [
                                                            "user_id" => Session::get('my_user_id'),
                                                        ])[0]->Total;
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="doanhthu" value={{$doanhthu}}>{{$doanhthu}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    SẢN PHẨM ĐÃ BÁN
                                </div>
                                <?php 
                                    $product = DB::select("select SUM(billdetail.Quantity) as ProductsSold
                                                from billdetail
                                                join product
                                                on billdetail.IdProduct = product.Id
                                                WHERE product.user_id = :user_id and billdetail.Status = 4", 
                                            [
                                                "user_id" => Session::get('my_user_id')
                                            ]);
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$product[0]->ProductsSold}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                  Rating
                                </div>
                                <?php 
                                    $AVG_Star = DB::select("SELECT AVG(rating.star) as AVG_Star
                                                FROM product
                                                join rating
                                                on product.Id = rating.ProductId
                                                where product.user_id = :user_id", 
                                            [
                                                "user_id" => Session::get('my_user_id')
                                            ]);
                                ?>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$AVG_Star[0]->AVG_Star}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-star fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    TỔNG COMMENT
                                </div>
                                <?php 
                                    $TotalComment = DB::select("SELECT COUNT(comment.Id) as TotalComment FROM product join comment on product.Id = comment.ProductId
                                                 where product.user_id = :user_id", 
                                            [
                                                "user_id" => Session::get('my_user_id')
                                            ]);
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$TotalComment[0]->TotalComment }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                        <h6 class="m-0 font-weight-bold text-primary">Top 5 Sản Phẩm Hot</h6>
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
<div id="shop-id" style="display: none;">{{ Session::get('my_user_id') }}</div>
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

    function GetDataChartDayRevenue(InputFromDateValue, InputToDateValue, ShopId) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listDate = [];
                    listRevenue = [];
                    response.GetDataChartDayRevenue.forEach((item) => {
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
        xhr.open('POST', '/GetDataChartDayRevenue');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            ShopId: ShopId,
            FromDate: InputFromDateValue,
            ToDate: InputToDateValue
        };
        xhr.send(JSON.stringify(data));   
    }          

    var shopId = document.querySelector('#shop-id').textContent;
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
    GetDataChartDayRevenue(fromDate, toDate, shopId);

    btnSearchDayRevenue.addEventListener('click', function(e) { 
        var InputFromDate = document.querySelector('#InputFromDate');  
        var InputToDate = document.querySelector('#InputToDate');  
        GetDataChartDayRevenue(InputFromDate.value, InputToDate.value, shopId);   
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

    function GetDataChartMonthRevenue(ShopId, Year, FromMonth, ToMonth) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listDate = [];
                    listRevenue = [];
                    response.GetDataChartMonthRevenue.forEach((item) => {
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
        xhr.open('POST', '/GetDataChartMonthRevenue');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            ShopId: ShopId,
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
    GetDataChartMonthRevenue(shopId, year, 1, 12);

    btnSearchMonthlyRevenue.addEventListener('click', function(e) { 
        var InputFromMonth = document.querySelector('#InputFromMonth');  
        var InputToMonth = document.querySelector('#InputToMonth'); 
        var now = new Date(); 
        var year = now.getFullYear();
        var FromMonth = InputFromMonth.value.split('-')[1];
        var ToMonth = InputToMonth.value.split('-')[1];
        GetDataChartMonthRevenue(shopId, year, FromMonth, ToMonth);  
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

    function GetDataChartStatusBill(ShopId) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listStatus = [];
                    listCount = [];
                    response.GetDataChartStatusBill.forEach((item) => {
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
        xhr.open('POST', '/GetDataChartStatusBill');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            ShopId: ShopId
        };
        xhr.send(JSON.stringify(data));   
    }      
    GetDataChartStatusBill(shopId);    

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

    function GetDataChartDayProduct(fromDate, toDate, shopId) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    listProduct= [];
                    listTotal = [];
                    response.GetDataChartDayProduct.forEach((item) => {
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
        xhr.open('POST', '/GetDataChartDayProduct');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            ShopId: shopId,
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
    GetDataChartDayProduct(fromDateTotalProduct, toDateTotalProduct, shopId);

    btnSearchDayProduct.addEventListener('click', function(e) { 
        var InputFromDateTotalProduct = document.querySelector('#InputFromDateTotalProduct');  
        var InputToDateTotalProduct = document.querySelector('#InputToDateTotalProduct');  
        GetDataChartDayProduct(InputFromDateTotalProduct.value, InputToDateTotalProduct.value, shopId);   
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

    function GetDataChartTopProduct(shopId) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {   
                    var response = JSON.parse(xhr.response); 
                    console.log(response);
                    listProduct = [];
                    listCountProduct = [];
                    response.GetDataChartTopProduct.forEach((item) => {
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
        xhr.open('POST', '/GetDataChartTopProduct');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        var data = {
            ShopId: shopId
        };
        xhr.send(JSON.stringify(data));   
    }      
    GetDataChartTopProduct(shopId);    
</script>
@endsection