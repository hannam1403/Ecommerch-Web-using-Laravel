<!-- Modal -->
<div class="modal fade" id="modalDetailProductListing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="overflow: auto;">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nội dung báo cáo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="overflow-y: auto;">
            <div id="info-product" class="row align-items-stretch" style="height: 450px; padding-bottom: 20px; padding-top: 30px; background-color: rgba(0, 0, 0, 0.05);">
              <div class="col-6">        
                  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="margin-left: 10px;">
                      <div class="carousel-inner" id="info-product-images">               

                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                  </div>
              </div>
              <div class="col-6" >           
                  <div class="mb-3 row">
                      <div class="col-sm-10">
                          <h4 style="text-align: left;" id="inputNameProduct">Name: </h4>
                      </div>    
                  </div>         
                  <div class="mb-3 row">
                    <label for="inputPrice" class="col-sm-2 col-form-label" style="text-align: left;">Price</label>
                    <div class="col-sm-5">
                      <div class="form-control-plaintext" id="inputPrice"></div>
                    </div>
                  </div>   
              </div>    
            </div>
            <div class="row align-items-stretch" style="margin-top: 20px; padding-bottom: 20px; padding-top: 20px; background-color: rgba(0, 0, 0, 0.05);">
              <div class="col" style="text-align: left;">
                  <h4>MÔ TẢ SẢN PHẨM</h4>
                  <div  style="text-align: left;" id="inputDescription">

                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
    </div>
    <script>
        // Đăng ký sự kiện click cho nút Edit
        document.querySelectorAll('.btn-edit').forEach(function(button) {
          button.addEventListener('click', function(event) {

            // Lấy dữ liệu của hàng được chọn
            var productId =  event.target.closest('tr').querySelector('td:nth-child(1)').textContent;
            var nameproduct = event.target.closest('tr').querySelector('td:nth-child(3)').textContent;
            var description = event.target.closest('tr').querySelector('td:nth-child(6)').textContent;
            var price = event.target.closest('tr').querySelector('td:nth-child(4)').textContent;

            
            // Điền dữ liệu vào modal
            
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Xử lý kết quả tìm kiếm và cập nhật giao diện
                        var response = JSON.parse(xhr.response);  
                        var product = response.product;
                        var images = response.images;
                        var infoProductImages = document.getElementById("info-product-images");
                        infoProductImages.innerHTML = "";

                        images.forEach(function(image, key) {
                          var div = document.createElement("div");
                          div.className = "carousel-item";
                          if (key == 0) {
                            div.className += " active";
                          }

                          var img = document.createElement("img");
                          img.src = "/images/Product/" + image.ImgProductPath;
                          img.className = "d-block w-100";
                          img.style = "width: 350px; height: 400px;";
                          img.id = "KeyImage-" + key;
                          img.alt = "...";

                          div.appendChild(img);
                          infoProductImages.appendChild(div);

                          document.getElementById("inputNameProduct").innerText = product[0].Name;
                          document.getElementById("inputDescription").innerHTML = product[0].Description;
                          document.getElementById("inputPrice").innerText = product[0].Price;
                        });                                                                    
                    }
                    else {
                    // Xử lý lỗi
                    }   
                }
            };
            xhr.open('GET', `/GetDataProductById?ProductId=${productId}`);
            xhr.send();
          });
        });
    </script>
      