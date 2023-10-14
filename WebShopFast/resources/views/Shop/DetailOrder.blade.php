<style>
    .subtable-container{
        display: block
        align-content: center;
        align-item: center;
        width: 100%;
    }
    .subtable {
        border-collapse: collapse;
        width: 100%;
    }
    .subtable-tr,
    .subtable-th {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        
    }

    .subtable-th {
        background-color: #f2f2f2;
    }
</style>

{{-- <div class="modal fade" id="modalDetailOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <section>
            <div class="row">    
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    <div class="table-responsive"> --}}
                    <div class="subtable-container">
                        <table class="table table-hover subtable">
                            <thead>
                            <tr class="subtable-tr">
                                <th class="subtable-th">Product Name</th>
                                <th class="subtable-th">Price</th>
                                <th class="subtable-th">Quantity</th>
                            </tr>
                            </thead>
                            <tbody> 
                            @foreach($details as $detail) 
                            <tr class="subtable-tr">
                                {{-- <td hidden>{{ $details->ID }}</td> --}}
                                <td class="subtable-th">{{ $detail->ProductName }}</td>
                                <td class="subtable-th">{{ $detail->Price }}</td>
                                <td class="subtable-th">{{ $detail->Quantity }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-10" style="text-align: right;">
                            Tổng thanh toán  <span name="TotalPrice"> {{ $totalPrices }} </span> VND
                        </div>
                    </div>
                        
                    {{-- </div>
                  </div>
                </div>
              </div>
            </div>  
        </section>
    </div>
</div> --}}

{{-- <script>
    const orderRows = document.querySelectorAll('.order-row');
    const modal = document.getElementById('order-details-modal');
    const modalContent = modal.querySelector('.modal-content');
    const modalBody = modal.querySelector('.modal-body');
    const closeBtn = modal.querySelector('.close');

    orderRows.forEach(row => {
        row.addEventListener('click', () => {
            const orderId = row.getAttribute('data-order-id');
            const url = "http://127.0.0.1:8081/DetailNewOrders/{:id}".replace(':id', orderId);

            fetch(url)
                .then(response => response.json())
                .then(order => {
                    modalBody.innerHTML = ''; // Clear the modal body
                    modalBody.appendChild(createOrderDetails(order)); // Add the order details to the modal body
                    modal.style.display = 'block'; // Show the modal
                });
        });
    });

    closeBtn.addEventListener('click', () => {
        console.log('Clicked on order:', row.getAttribute('data-order-id'));
        modal.style.display = 'none'; // Hide the modal when the close button is clicked
    });

    function createOrderDetails(order) {
        const details = document.createElement('div');
        details.innerHTML = `
            <p><strong>Order ID:</strong> ${order.id}</p>
            <p><strong>Customer Name:</strong> ${order.customer_name}</p>
            <p><strong>Order Date:</strong> ${order.order_date}</p>
            <p><strong>Total Amount:</strong> $${order.total_amount.toFixed(2)}</p>
            <p><strong>Items:</strong></p>
            <ul>
                ${order.items.map(item => `<li>${item.name} (${item.quantity} x $${item.price.toFixed(2)} = $${(item.quantity * item.price).toFixed(2)})</li>`).join('')}
            </ul>
        `;
        return details;
    }
</script> --}}
