    <!-- Modal -->
    <div class="modal fade" id="modalAddCarrier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <form action="/CarrierManager/addCarrier" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Carrier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-2 col-form-label">Carrier Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputAddress"  name="address">
                        </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputPhoneNumber"  name="phonenumber">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail"  name="email">
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPrice"  name="price">
                            </div>
                        </div>                       --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
          