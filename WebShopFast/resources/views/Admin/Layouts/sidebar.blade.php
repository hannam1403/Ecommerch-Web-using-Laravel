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
              {{-- <a href="/DetailShop/{{ Session::get('my_user_id')}}" style="text-decoration: none">
                <li class="list-group-item">Thông tin cá nhân</li>
              </a> --}}
              <a href="{{ route('logout') }}" style="text-decoration: none">
                <li class="list-group-item">Đăng Xuất</li>
              </a>             
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Quản lý khách hàng
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/MemberManager" style="text-decoration: none">
                <li class="list-group-item">Thông tin và khóa tài khoản khách hàng</li>
              </a>
              <a href="/UnlockMember" style="text-decoration: none">
                <li class="list-group-item">Mở khóa tài khoản khách hàng</li>
              </a>         
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Quản lý bài đăng sản phẩm
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/ProductListingManager" style="text-decoration: none">
                <li class="list-group-item">Thông tin bài đăng sản phẩm</li>
              </a>        
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Quản lý đơn vị vận chuyển
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/CarrierManager" style="text-decoration: none">
                <li class="list-group-item">Thông tin đơn vị vận chuyển</li>
              </a>   
              <a href="/DeletedCarrierManager" style="text-decoration: none">
                <li class="list-group-item">Các đơn vị vận chuyển bị xóa</li>
              </a>     
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              Quản lý danh mục sản phẩm
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/CategoryManager" style="text-decoration: none">
                <li class="list-group-item">Thông tin danh mục sản phẩm</li>
              </a>        
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
              Quản lý Banner Trang Web
            </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/BannerManager" style="text-decoration: none">
                <li class="list-group-item">Thông tin Banner Trang Web</li>
              </a>        
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingSeven">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
              Quản lý Doanh thu 
            </button>
          </h2>
          <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/WebIncome" style="text-decoration: none">
                <li class="list-group-item">Doanh thu</li>
              </a>        
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingEight">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
              Quản lý Marketing
            </button>
          </h2>
          <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/MarketingManager" style="text-decoration: none">
                <li class="list-group-item">Danh mục Marketing</li>
              </a> 
              <a href="/MarketingProductManager" style="text-decoration: none">
                <li class="list-group-item">Danh sách các sản phẩm Marketing</li>
              </a>        
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTen">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
              Quản lý Comment
            </button>
          </h2>
          <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/CommentManager" style="text-decoration: none">
                <li class="list-group-item">Thông tin Comment</li>
              </a>        
            </ul>
          </div>
        </div>
        <?php
                $reportproduct = DB::table('reportproduct')
                                ->get();
                $reportcomment = DB::table('reportcomment')
                    ->select('reportcomment.Id as Id', 'reportcomment.MemberId as MemberId', 'member.Id as ReportedMemberId', 'reportcomment.CommentId as CommentId', 'reportcomment.Content as Content', 'comment.Content as Comment')
                    ->join('comment', 'comment.Id', '=', 'reportcomment.CommentId')
                    ->join('member', 'comment.MemberId', '=', 'member.Id')
                    ->where('comment.deleted', '=', '0')
                    ->get();
        ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingNine">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
              Quản lý Báo cáo
            <span style="font-size: 1.0rem; position: absolute; right: 28%; top: 32.5%; background-color: orange; border-radius: 100%; padding: 2px 7px">{{ count($reportproduct) + count($reportcomment) }}</span>
            </button>
          </h2>
          <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
            <ul class="list-group">
              <a href="/ReportProductManager" style="text-decoration: none">
                <li class="list-group-item">
                  Báo cáo sản phẩm
                  <span style="position: absolute; right: 20%; top: 25%; background-color: orange; border-radius: 100%; padding: 0 8px">{{ count($reportproduct) }}</span>
                </li>
              </a> 
              <a href="/ReportCommentManager" style="text-decoration: none">
                <li class="list-group-item">
                  Báo cáo comment
                  <span style="position: absolute; right: 20%; top: 24.5%;  background-color: orange; border-radius: 100%; padding: 0 8px">{{ count($reportcomment) }}</span>
                </li>
              </a>    
            </ul>
          </div>
        </div>
      </div>
  </nav>