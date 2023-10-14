<div class="p-3 text-center bg-white border-bottom">
    <div class="container">
      <div class="row gy-3">
        <!-- Left elements -->
        <div class="col-4">
          <a href="{{ url('/') }}"  class="float-start">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" height="35" />
          </a>
        </div>
        <!-- Left elements -->

        <!-- Center elements -->
        <div class="order-lg-last col-8">
          <div class="d-flex float-end">
            @if(Session::has('username') && !empty(Session::get('username')))
              <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-user-alt m-1 me-md-2"></i>  {{ Session::get('username') }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="/detailAccount/{{ Session::get('my_user_id')}}">My Account</a></li>
                  <li><a class="dropdown-item" href="/MyOrder">My Order</a></li>
                  <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
              </div>
            @else 
              <a href="/register" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center" > 
                <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Sign up</p> 
              </a>
              <a href="/login" class="border rounded py-1 px-3 nav-link d-flex align-items-center" > 
                <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Sign in</p> 
              </a>
            @endif                
          </div>                          
        </div>
        <!-- Center elements -->

      </div>
    </div>
</div>