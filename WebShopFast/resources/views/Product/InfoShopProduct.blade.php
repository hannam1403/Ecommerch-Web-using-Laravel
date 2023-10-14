 <!-- Scrolling Modal -->
<div class="modal fade" id="InfoDetailShop" tabindex="-1" aria-labelledby="scrollingModalLabel" aria-hidden="true" style="padding-top: 80px;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="scrollingModalLabel">Thông tin Shop</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class=row>
                <?php 
                    $user = DB::select("call GetAccountDetail(:id)", 
                    [
                        'id' => $shop->Id,
                    ]);    

                    $dataTongProduct = DB::select("SELECT count(product.Id) as TongSoSP FROM member JOIN product on member.Id = product.user_id WHERE member.id = :MemberId", 
                    [
                        'MemberId' => $shop->Id
                    ]);

                    if (empty($dataTongProduct)) {
                        $TongProduct = 0;
                    } 
                    else {
                        $TongProduct = $dataTongProduct[0]->TongSoSP;
                    }
                ?>
                <div class="col-3">
                    <img src="{{ $user[0]->ava_img_path == null ? asset('images/AvatarImage/defaultAvatarProfile.jpg') : asset('images/AvatarImage/'.$user[0]->ava_img_path) }}" class="rounded-circle" 
                                style="width: 150px; height: 150px;"
                                alt="Avatar" />
                </div>
                <div class="col-9">                   
                    <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between">
                        <div style="font-weight: bold; font-size: 16px;">Tên Shop: <span style="font-weight: normal; font-size: 16px;">{{$user[0]->Name}}</span></div>
                        <div style="font-weight: bold; font-size: 16px;">Số sản phẩm: <span style="font-weight: normal; font-size: 16px;">{{$TongProduct}}</span></div>
                        <div style="font-weight: bold; font-size: 16px;">Số điện thoại: <span style="font-weight: normal; font-size: 16px;">{{$user[0]->Phone}}</span></div>
                        <div style="font-weight: bold; font-size: 16px;">Địa chỉ: <span style="font-weight: normal; font-size: 16px;">{{$user[0]->Address}}</span></div>
                    </div>         
                </div>
            </div>
            <div class=row style="margin-top: 20px">
                <h5>Các sản phẩm của Shop</h5>
                <?php 
                    use App\Models\Product;
                    $dataProducts = DB::table('product')
                            ->leftJoinSub(
                                'SELECT productId, MIN(ImgProductPath) AS ImgProductPath FROM imageproduct GROUP BY productId',
                                'first_image',
                                function ($join) {
                                    $join->on('product.Id', '=', 'first_image.productId');
                                }
                            )
                            ->join('subcategory', 'product.SubCategoryId', '=', 'subcategory.Id')
                            ->join('member', 'product.user_id', '=', 'member.Id')
                            ->where('member.userstatus', 1)
                            ->select('product.Id', 'product.Name', 'product.Price', 'product.Description', 
                                'product.CategoryId', 'product.user_id', 'product.QuantityInStock', 
                                'first_image.ImgProductPath', 'subcategory.Name as subcategoryName')
                            ->where('product.user_id','=',$shop->Id)
                            ->where('product.deleted', 0)
                            ->orderByDesc('product.Id')
                            ->get();                 
                ?>
                @foreach($dataProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card my-2 shadow-0" name="BoxProduct">
                      <div name="ProductId" value={{$product->Id}}></div>
                      <a href="/detailProduct/{{$product->Id}}">           
                        <img src="{{ asset('images/Product/'.$product->ImgProductPath) }}" name="ProductImage" class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
                      </a>
                      <div class="card-body p-0 pt-3 ps-2">
                        <h5 class="card-title" name="ProductPrice" value={{$product->Price}}>{{$product->Price}}</h5>
                        <p class="card-text mb-0" name="ProductName">{{$product->Name}}</p>
                        <p class="text-muted">
                          Subtype: {{$product->subcategoryName}}
                        </p>
                      </div>
                    </div>
                  </div>
                @endforeach 
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>