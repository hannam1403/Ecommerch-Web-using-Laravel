<!-- Modal -->
<div class="modal fade" id="modalEditAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <form action="/AddressManager/Edit" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Carrier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" hidden class="form-control" id="inputEditId" name="id">
                    <div class="mb-3 row">
                        <label for="inputEditAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditAddress"  name="address">
                        </div>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
        // Đăng ký sự kiện click cho nút Edit
        document.querySelectorAll('.btn-edit').forEach(function(button) {
          button.addEventListener('click', function(event) {

            // Lấy dữ liệu của hàng được chọn
            var id = event.target.closest('tr').querySelector('td:nth-child(1)').textContent;
            var address = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
     
            // Điền dữ liệu vào modal
            document.getElementById("inputEditId").value = id;
            document.getElementById("inputEditAddress").value = address;

          });
        });
    </script>
      