    <!-- Modal -->
    <div class="modal fade" id="modalAddCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <form action="/CategoryManager/addCategory" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New SubCategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="category" id="category"> 
                                    <?php 
                                        $categoriess =  DB::select("select * from categoryproduct");
                                        foreach ($categoriess as $categoryy) {
                                    ?>                               
                                                <option value={{$categoryy->Id}} >{{$categoryy->Name}}</option>                         
                                    <?php
                                        }
                                    ?>   
                                </select>                               
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-2 col-form-label">SubCategory Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" name="Name">
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
          