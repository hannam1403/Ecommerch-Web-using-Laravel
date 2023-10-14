    <!-- Modal -->
<script src="/ckeditor/ckeditor.js"></script>
<div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="overflow: auto;">
            <form action="/ProductManager/addProduct" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputPrice"  name="price" min="1000" step="1000">
                    </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputQuantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputQuantity"  name="quantity" min="1">
                        </div>
                        </div>
                    <div class="mb-3 row">
                        <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-select mb-3" aria-label=".form-select-lg example" name="category" id="category"> 
                                <?php 
                                    $categories =  DB::select("select * from categoryproduct");
                                    foreach ($categories as $category) {
                                ?>                               
                                            <option value={{$category->Id}} >{{$category->Name}}</option>                         
                                <?php
                                    }
                                ?>   
                            </select>                               
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputCategory" class="col-sm-2 col-form-label">SubCategory</label>
                        <div class="col-sm-10">
                            <select class="form-select mb-3" aria-label=".form-select-lg example" name="subCategory" id="subCategory">  
                                
                            </select>                               
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="inputDescription" rows="10" cols="80">

                        </textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor 4
                            // instance, using default configuration.
                            CKEDITOR.replace( 'inputDescription' );
                        </script>
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
<script>
    var categoryElement = document.getElementById("category");

    function GetSubCategory() {
        var categoryId = document.querySelector('#category').value;
        var subCategoryElement = document.querySelector('#subCategory');
        subCategoryElement.innerHTML = ""; 

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Xử lý kết quả tìm kiếm và cập nhật giao diện
                    var response = JSON.parse(xhr.response);  
                    var subcategories = response.subcategories;
                    subcategories.forEach(subcategory => {
                        var option = document.createElement('option');
                        option.value = subcategory.Id;
                        option.text = subcategory.Name;
                        subCategoryElement.appendChild(option);
                    });                                                     
                }
                else {
                // Xử lý lỗi
                }   
            }
        };
        xhr.open('GET', '/ProductManager/GetSubCategoryByCategory/' + categoryId);
        xhr.send();
    }

    GetSubCategory();

    categoryElement.addEventListener('change', function(e) {
        GetSubCategory();
    });

</script>

