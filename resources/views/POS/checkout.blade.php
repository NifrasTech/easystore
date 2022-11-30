<div class="modal checkout-modal fade" id="modal-checkout">
  <div class="modal-dialog">
    <form class="modal-content pt-0" method="POST" onsubmit="proceedCheckout(event)">
      <div class="modal-header mb-1">
        <h5 class="modal-title">Checkout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
    <div class="row">
        <div class="col-md-4">
        <label>Bill Total:</label>
        
            <input type="text" value="" id="sub-total" class="form-control mb-2" readonly/>

        </div>
        <div class="col-md-8">
        <label>Discount:</label>
          <div class="input-group">
              <span class="input-group-text"><i class="fas fa-cut"></i></span>
              <input
                type="number"
                class="form-control"
                placeholder="Discount"
                id="txtDiscount"
              />
              <button class="btn btn-primary" type="button" id="btn-discount" onclick="applyDiscount()">APPLY</button>
              </div>
        </div>
      </div>
      <div class="d-flex checkout-area flex-column">
        <ul class="list-group-flush list-group">
          <li class="list-group-item d-flex justify-content-between">
            <p class="m-0"><strong>Total to pay: </strong></p>
            <h3 id="total-to-pay">Rs. 0</h3>
          </li>
        
        </ul>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                placeholder="Paid"
                aria-describedby="basic-addon1"
                id="txtPaid"
              />
                    <button
                      type="button"
                      class="btn btn-primary dropdown-toggle"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      id="btn-pay"
                    >
                      PAY
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#" onclick="addPayment('cash')">CASH</a>
                      <a class="dropdown-item" href="#" onclick="addPayment('cheque')">CHEQUE</a>
                      <a class="dropdown-item" href="#" onclick="addPayment('credit')">CREDIT</a>
                      <a class="dropdown-item" href="#" onclick="addPayment('other')">OTHER</a>
                    </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="table-responsive">
              <table class="table table-hover">
                <tbody class="tbl-payment">
                  <tr><td class="text-center">Payments are Empty!</td></tr>
                </tbody>
              </table>
          </div>
          </li>
          <li class="list-group-item d-flex justify-content-between flex-column">
            <input type="text" id="txtReference" class="form-control" placeholder="Reference">
            <input type="text" id="txtNote" class="form-control mt-1" placeholder="Note...">
          </li>
          <li class="list-group-item">
            <button type="submit" class="btn btn-success col-12">PROCEED</button>
          </li>
        </ul>
      </div>
    </div>
    </form>
  </div>
</div>

@push('custom-scripts')
<script>
  let cartTotal = 0
  let discount = 0
  let totalToPay = 0
  let paid = 0
  let payments = []
  
  function onCheckout(){
    cartTotal = cartLS.total()
    totalToPay = cartTotal
    $('#sub-total').val('Rs. '+Intl.NumberFormat().format(cartTotal))
    $('#total-to-pay').html('Rs. '+Intl.NumberFormat().format(totalToPay))
  }

  function openCheckout(){
    onCheckout()
    if(cartVerify()){
      $('#modal-checkout').modal('show')
    }
  }

  function applyDiscount(){
    discount = $('#txtDiscount').val()
    totalToPay = cartTotal-discount
    $('#total-to-pay').html('Rs. '+Intl.NumberFormat().format(totalToPay))
  }

  function addPayment(payMethod){
    let txtPayment=$('#txtPaid').val()
    if(txtPayment==0 || txtPayment.trim()=="") alert('Incorrect Amount')
    else{
      payments.push({method: payMethod, amount: txtPayment})
      showPayment()
      console.log(payments)
    }
  }

  function showPayment(){
    $('.tbl-payment').html()

    let paymentRow = ""
    let count = 0
    paid = 0
    payments.map((payment,index)=>{
      paymentRow+=`
        <tr>
            <td>
              <b>Rs. ${payment.amount}</b>
            </td>
            <td><small>By ${payment.method}</small></td>
            <td class="pe-0">
              <a href="#" onclick="removePayment(${index})">
                    X
              </a>
            </td>
        </tr>
      `
      paid+=Number(payment.amount)
      console.log(paid)
    })

    if(payments.length==0) paymentRow = '<tr><td class="text-center">Payments are Empty!</td></tr>'
    $('.tbl-payment').html(paymentRow)
  }

  function removePayment(payment){
    payments.splice(payment,1)
    showPayment()
  }

  function proceedCheckout(event){
    event.preventDefault()
    if(paid<totalToPay) {alert('Please complete your payment Rs. '+ (totalToPay-paid))}
    else if (paid>totalToPay) {alert('Extra Ammount cannot be added Rs. '+ (totalToPay-paid))}
    else{
      $.ajax({
        url:"{{route('checkout')}}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          payments:JSON.stringify(payments),  
          cart:JSON.stringify(cartLS.list()),
          total: cartTotal,
          discount: discount,
          note: $('#txtNote').val(),
          reference: $('#txtReference').val(),
          contact: $('#cmb-contact').val(),
        },
        dataType: "json",
        success: function( data ) {
           if(data.type=="success"){
            cartLS.destroy()
            showCart()
            //Redirect to reciept
            toastMessage('Thank you.. Sale Completed','success','Success')
            window.location.replace(`{{route('sale-reciept','')}}/${data.reciept}`)
           }             
        }
      })
    }
  }
</script>
@endpush