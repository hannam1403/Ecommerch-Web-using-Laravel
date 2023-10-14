    <!-- Modal -->
    <div class="modal fade" id="modalAddImageProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <form action="/ImageProductManager/addImageProduct" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Image Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-10">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="ProductID">
                                    <?php
                                        $products  = DB::table('product')
                                        ->where('product.user_id','=',Session::get('my_user_id'))
                                        ->where('product.deleted','=','0')
                                                        ->get();
                                    
                                    foreach($products as $product) 
                                    {
                                    ?>
                                        <option value="{{ $product->Id }}">{{ $product->Name }}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="inputDescription" class="col-sm-2 col-form-label">Image</label>
                            </div>
                            <div class="col-sm-10">
                                <input  type="file" class="form-control" id="formFile" name="ImageProduct">   
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
          