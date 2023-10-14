    <!-- Modal -->
    <div class="modal fade" id="modalAddBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <form action="/BannerManager/addBanner" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                                <label for="inputName" class="col-sm-2 col-form-label">Banner Name</label>
                            <div class="col-sm-10">
                                <input  type="text" class="form-control" id="inputName" name="BannerName">   
                            </div>
                        </div> 
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="inputDescription" class="col-sm-2 col-form-label">Banner Image</label>
                            </div>
                            <div class="col-sm-10">
                                <input  type="file" class="form-control" id="formFile" name="ImageBanner">   
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
          