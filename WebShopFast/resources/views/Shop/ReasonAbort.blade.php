    <!-- Modal -->
    <div class="modal fade" id="modalReasonAbort" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <form action="/DetailPreDeliveryOrders/DeliveryNotSuccess" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chọn lí do hủy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" hidden class="form-control" id="inputReasonId" name="Id">
                        <div class="mb-3 row">
                            <label for="inputReason" class="col-sm-2 col-form-label">Lí do</label>
                            <div class="col-sm-10">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" id="inputReasonCategory" name="reason"> 
                                    <?php 
                                        $reasons =  DB::select("select * from reasonabort");
                                        foreach ($reasons as $reason) {
                                    ?>                               
                                                <option value={{$reason->Id}} >{{$reason->Reason}}</option>                         
                                    <?php
                                        }
                                    ?>   
                                </select>                               
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
            var reason_id = event.target.closest('tr').querySelector('td:nth-child(1)').textContent;
            var reason = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
            
            // Điền dữ liệu vào modal
            document.getElementById("inputReasonId").value = reason_id;
  
            var selectElement = document.getElementById("inputReasonCategory");
           
            var options = selectElement.options;
            //console.log(options);
            for (var i = 0; i < options.length; i++) {
                if (options[i].label == reason) {
                    options[i].selected = true;
                    break;
                }
            }
          });
        });
    </script>
      
          