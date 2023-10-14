<nav id="sidebarMenu" class="collapse d-lg-block sidebar bg-white" style="max-width: 250px;">
    <div style="width: 100%; height: 100px; display: flex; justify-content: center;">
        <a href="/"  class="float-start">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" height="100px" width="100%" />
        </a>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Quản lý tài khoản
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/DetailShop/{{ Session::get('my_user_id')}}" style="text-decoration: none">
                <li class="list-group-item">Thông tin cá nhân</li>
              </a>
              <a href="{{ route('logout') }}" style="text-decoration: none">
                <li class="list-group-item">Đăng Xuất</li>
              </a>             
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Quản lý sản phẩm
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/ProductManager" style="text-decoration: none">
                <li class="list-group-item">Sản phẩm</li>
              </a>        
              <a href="/ImageProductManager" style="text-decoration: none">
                <li class="list-group-item">Hình ảnh sản phẩm</li>
              </a>
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"aria-controls="flush-collapseThree">
              Quản lý đơn hàng
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/DetailNewOrders" style="text-decoration: none">
                <li class="list-group-item">Đơn hàng </li>
              </a>  
              {{-- <a href="/DetailDoneOrders" style="text-decoration: none">
                <li class="list-group-item">Đơn hàng đã hoàn thành</li>
              </a>      
              <a href="/DetailAbortOrders" style="text-decoration: none">
                <li class="list-group-item">Đơn hàng đã hủy</li>
              </a>   --}}
            </ul>
          </div>
        </div>
        
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false"aria-controls="flush-collapseFour">
              Quản lý vận chuyển 
            </button>
          </h2>
          <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/ShopCarrier" style="text-decoration: none">
                <li class="list-group-item">Chọn đơn vị vận chuyển cho đơn hàng</li>
              </a>  
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false"aria-controls="flush-collapseSix">
              Marketing 
            </button>
          </h2>
          <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/MarketingProduct" style="text-decoration: none">
                <li class="list-group-item">Marketing Sản Phẩm</li>
              </a>  
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false"aria-controls="flush-collapseFour">
              Hỗ Trợ Khách Hàng 
            </button>
          </h2>
          <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/ChatSupportUser" style="text-decoration: none">
                <li class="list-group-item">Chat Trực Tuyến </li>
              </a>  
            </ul>
          </div>
        </div>
      </div>
  </nav>