<!-- Modal -->
<div class="modal fade" id="modalEditCarrier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <form action="/CarrierManager/Edit" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Carrier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" hidden class="form-control" id="inputEditId" name="id">
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-2 col-form-label">Carrier Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEditName" name="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEditAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditAddress"  name="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEditPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputEditPhoneNumber"  name="phonenumber">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEditEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEditEmail"  name="email">
                        </div>
                    </div>
                    {{-- <div class="mb-3 row">
                        <label for="inputEditPrice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditPrice"  name="price">
                        </div>
                    </div>                    --}}
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
            var name = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
            var address = event.target.closest('tr').querySelector('td:nth-child(3)').textContent;
            var phone = event.target.closest('tr').querySelector('td:nth-child(4)').textContent;
            var email = event.target.closest('tr').querySelector('td:nth-child(5)').textContent;
            //var price = event.target.closest('tr').querySelector('td:nth-child(6)').textContent;

            
            // Điền dữ liệu vào modal
            document.getElementById("inputEditId").value = id;
            document.getElementById("inputEditName").value = name;
            document.getElementById("inputEditAddress").value = address;
            document.getElementById("inputEditPhoneNumber").value = phone;
            document.getElementById("inputEditEmail").value = email;
            //document.getElementById("inputEditPrice").value = price;

          });
        });
    </script>
      