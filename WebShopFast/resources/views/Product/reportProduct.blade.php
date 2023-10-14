<div class="modal fade" id="ModalReportProduct" tabindex="-1" aria-labelledby="ModalReportProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <form action="/detailProduct/ReportProduct" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="ModalReportProductLabel">Báo cáo sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">               
                    <input id="ReportProductId" name="ReportProductId" hidden value={{ $product->getId() }}>
                    <input id="ReportMemberId" name="ReportMemberId" hidden value={{ Session::get('my_user_id') }}>
                    <div class="mb-3 row">
                        <label for="inputReportContent" class="col-sm-2 col-form-label">Nội dung:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="inputReportContent" id="inputReportContent" rows="10"></textarea>
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
