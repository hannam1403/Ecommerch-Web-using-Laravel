<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" type="image/x-icon" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" /> 
    <link href="/fontawesome-6.4.0/css/fontawesome.css" rel="stylesheet">
    <link href="/fontawesome-6.4.0/css/brands.css" rel="stylesheet">
    <link href="/fontawesome-6.4.0/css/solid.css" rel="stylesheet">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop Fast</title>
    <style>
        html, body {
            height: 100%;       
        }

        .my_container {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .main_header, .main_footer {
            flex-shrink: 0;
        }

        .main-content {
            flex: 1;
        }

        .quantity {
            display: flex;
            margin-bottom: 33px;
            
        }

        .quantity .pro-qty {
            display: flex;
            width: 123px;
            height: 46px;
            margin-left: 18%;
            border: 2px solid #ebebeb;
            padding: 0 15px;
            /* float: left; */
            /* right: 30px;
            margin-right: 30px; */
            background-color: white;
        }

        .quantity .pro-qty .qtybtn {
            font-size: 24px;
            color: #b2b2b2;
            float: left;
            line-height: 38px;
            cursor: pointer;
            width: 18px;
        }

        .quantity .pro-qty .qtybtn.dec {
            font-size: 30px;
        }

        .quantity .pro-qty input {
            text-align: center;
            width: 52px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            color: #4c4c4c;
            line-height: 40px;
            float: left;
        }
    </style>
<body>   
    {{-- @include('layouts.header')
    @yield('content')
    @include('layouts.footer') --}}


    <div class="my_container">
        <div class="main_header">
            @include('ProductCheckout.Layouts.header')
        </div>

        <div class="main-content">
            @yield('content')
        </div>

        <div class="main_footer">
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>