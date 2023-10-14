<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" type="image/x-icon" />

    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/Account/login.css') }}">
</head>
<body>
    @include('error')
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <a href="/">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                style="width: 185px;" alt="logo">
                        </a>
                        <h4 class="mt-1 mb-5 pb-1">We are The Shop Fast</h4>
                      </div>
      
                      <form action="/login" method="POST">
                        @csrf
                        @if(Session::has('Error') 
                            && !empty(Session::get('Error') 
                            && Session()->get('Error') == true))
                          <div class="alert alert-danger" role="alert">
                            <?php echo Session::get('Error') ?>
                          </div>
                            <?php Session()->forget('Error'); ?>       
                        @endif

                        <p>Please login to your account</p>
      
                        <div class="form-outline mb-4">
                          <input type="text" id="form2Example11" class="form-control" name="username" required
                            placeholder="Username" />
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" id="form2Example22" class="form-control" name="password" required
                            placeholder="Password"  />
                        </div>

                        {{-- <div class="form-outline mb-4">
                          <select class="form-select mb-3" aria-label=".form-select-lg example" name="roleid">
                            <option selected value="1">Admin</option>
                            <option value="2">Người mua</option>
                            <option value="3">Người bán</option>
                          </select>
                        </div> --}}
      
                        <div class="form-outline mb-4" style="text-align: center">
                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" style="width: 100%;" type="submit">
                                Login
                            </button>    
                        </div>                       
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Don't have an account?</p>
                          <a href="/register">
                            <button type="button" class="btn btn-outline-danger">Create new</button>
                          </a>
                        </div>   
                      </form>     
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4"  style="width: max-content;">We are more than just a Shop</h4>
                      <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>