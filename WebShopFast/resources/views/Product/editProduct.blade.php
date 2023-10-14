<!-- Modal -->
<script src="/ckeditor/ckeditor.js"></script>
    <div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content" style="overflow: auto;">
                <form action="/ProductManager/Edit" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" hidden class="form-control" id="inputEditId" name="Id">
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEditName" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputEditPrice"  name="price">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEditQuantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputEditQuantity"  name="quantity">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" id="inputEditCategory" name="category"> 
                                    <?php 
                                        $products =  DB::select("select * from categoryproduct");
                                        foreach ($products as $product) {
                                    ?>                               
                                                <option value={{$product->Id}} >{{$product->Name}}</option>                         
                                    <?php
                                        }
                                    ?>   
                                </select>                               
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">SubCategory</label>
                            <div class="col-sm-10">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="subCategory" id="inputEditSubCategory">  
                                    
                                </select>                               
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                {{-- <textarea class="form-control" id="inputEditDescription" rows="3" name="description"></textarea> --}}
                                <textarea name="description" id="inputEditDescription" rows="10" cols="80">

                                </textarea>
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
                CKEDITOR.replace( 'inputEditDescription' );
                // Lấy dữ liệu của hàng được chọn
                var product_id = event.target.closest('tr').querySelector('td:nth-child(1)').textContent;
                var productName = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
                var price = event.target.closest('tr').querySelector('td:nth-child(3)').textContent;
                var quantity = event.target.closest('tr').querySelector('td:nth-child(4)').textContent;
                var category = event.target.closest('tr').querySelector('td:nth-child(5)').textContent;
                var subCategory = event.target.closest('tr').querySelector('td:nth-child(6)').textContent;
                var description = event.target.closest('tr').querySelector('td:nth-child(7)').textContent;
                
                // Điền dữ liệu vào modal
                document.getElementById("inputEditId").value = product_id;
                document.getElementById("inputEditName").value = productName;
                document.getElementById("inputEditPrice").value = price;
                document.getElementById("inputEditQuantity").value = quantity;

                CKEDITOR.instances.inputEditDescription.setData(description);

                var categoryElement = document.getElementById("inputEditCategory");
                
                var optionsCategory = categoryElement.options;
                //console.log(options);
                for (var i = 0; i < optionsCategory.length; i++) {
                    if (optionsCategory[i].label == category) {
                        optionsCategory[i].selected = true;
                        break;
                    }
                }

                var categoryId = document.querySelector('#inputEditCategory').value;
                var subCategoryElement = document.querySelector('#inputEditSubCategory');
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
                            
                            var optionsSubCategory = subCategoryElement.options;
                            //console.log(options);
                            for (var i = 0; i < optionsSubCategory.length; i++) {
                                if (optionsSubCategory[i].label == subCategory) {
                                    optionsSubCategory[i].selected = true;
                                    break;
                                }
                            }
                        }
                        else {
                        // Xử lý lỗi
                        }   
                    }
                };
                xhr.open('GET', '/ProductManager/GetSubCategoryByCategory/' + categoryId);
                xhr.send();
                             
                //document.getElementById("inputEditDescription").value = description;                    
            });
        });
    </script>
          
