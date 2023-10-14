<div class="modal fade" id="ChangePaymentMethodModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Phương thức thanh toán</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php 
                $user_id = Session::get('my_user_id');
                $cart = DB::select("select * from cart where status = 0 and member_id = :user_id",
                [
                    "user_id" => $user_id 
                ]);
                $PaymentChoose = DB::select("select paymentMethod.ID, paymentMethod.Name from cart 
                        join paymentMethod
                        on cart.PaymentMethodId = paymentMethod.Id 
                        where cart.Id = :CartId", 
                        [
                            "CartId" => $cart[0]->Id
                        ]);       
                $Payments = DB::select("select * from PaymentMethod");                            
            ?>
            @foreach($Payments as $Payment) 
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="RadioPaymentMethod" value="{{$Payment->ID}}" id="Paymet-{{$Payment->ID}}" @if($Payment->ID == $PaymentChoose[0]->ID) checked @endif>
                  <label class="form-check-label" for="Paymet-{{$Payment->ID}}">
                    {{ $Payment->Name }}
                  </label>
              </div>
            @endforeach
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary"  data-bs-dismiss="modal">Trở về</button>
          <button class="btn btn-primary" id="ButtonUpdatePaymentMethod"  data-bs-dismiss="modal">Hoàn thành</button>
        </div>
      </div>
    </div>
</div>

<div id="cart-id" style="display: none;">{{ $cart[0]->Id }}</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  var ButtonUpdate = document.getElementById("ButtonUpdatePaymentMethod");
  var PaymentMethodName = document.getElementById("PaymentMethodName");
  var cartId = document.querySelector('#cart-id').textContent;

  ButtonUpdate.addEventListener("click", function() {
    var PaymentMethodID = document.querySelector('input[name="RadioPaymentMethod"]:checked').value;
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
          if (xhr.status === 200) {   
              var response = JSON.parse(xhr.response);                             
              PaymentMethodName.textContent = response.PaymentMethodName;
          } else {
              // Xử lý logic khi lỗi

          }
      }
    };
    xhr.open('POST', '/UpdatePaymentMethod');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', token);
    var data = {
        paymentMethodID: PaymentMethodID,
        cartId: cartId
    };
    xhr.send(JSON.stringify(data));
  })

</script>