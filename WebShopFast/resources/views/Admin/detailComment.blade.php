<!-- Modal -->
<div class="modal fade" id="modalDetailComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <input type="text" hidden class="form-control" id="inputId" name="id"> --}}
                    <div class="mb-3 row">
                        <label for="inputId" class="col-sm-2 col-form-label">Comment Id</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputId" name="Id" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputUser" class="col-sm-2 col-form-label">User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUser"  name="User" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputProductId" class="col-sm-2 col-form-label">Product Id</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputProductId"  name="ProductId" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputContent" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputContent" name="Content" disabled style="height: auto; min-height: 100px; max-height: 300px; resize: vertical;"></textarea>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <a href="/ProductListingManager/Delete/{{$product->Id}}" onclick="return confirmDelete(event)">
                        <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Delete</button>
                      </a>  --}}
                </div>
        </div>
    </div>
    </div>
    <script>
        // Đăng ký sự kiện click cho nút Edit
        document.querySelectorAll('.btn-edit').forEach(function(button) {
          button.addEventListener('click', function(event) {

            // Lấy dữ liệu của hàng được chọn
            var Id = event.target.closest('tr').querySelector('td:nth-child(1)').textContent;
            var User = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
            var ProductId = event.target.closest('tr').querySelector('td:nth-child(3)').textContent;
            var Content = event.target.closest('tr').querySelector('td:nth-child(4)').textContent;

            
            // Điền dữ liệu vào modal
            document.getElementById("inputId").value = Id;
            document.getElementById("inputUser").value = User;
            document.getElementById("inputProductId").value = ProductId;
            document.getElementById("inputContent").value = Content;
          });
        });

    //     function confirmDelete(event) {
    //       if (!confirm("Bạn có chắc chắn muốn xóa bài đăng này?")) {
    //           event.preventDefault();
    //           return false;
    //       }
    //       return true;
    //   }
    </script>
      