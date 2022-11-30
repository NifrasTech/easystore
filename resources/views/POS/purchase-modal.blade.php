<div class="modal fade" id="modal-purchase" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title">Purchase</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="" id="frm-purchase" method="POST">
            <div class="row mb-md-1">
              <div class="col-md-4 mb-1">
              <label class="form-label">Purchase Total :</label>
                <input type="text" class="form-control fs-4 fw-bold" id="purchase-total" readonly>
              </div>

              <div class="col-md-4 mb-1">
              <label class="form-label">Discount :</label>
                <input type="number" step="0.01" id="purchase-discount" class="form-control fs-4 fw-bold" >
              </div>

              <div class="col-md-4 mb-1">
              <label class="form-label">After Discount :</label>
                <input type="text" class="form-control fs-4 fw-bold" id="after-discount" readonly>
              </div>
            </div>
            <div class="row mb-md-1">
            <div class="col-md-4">
                <label class="form-label">Store</label>
                <select class="select2 form-select text-capitalize mb-md-0 mb-2" id="cmb-store" required>
                <option value="">SELECT A STORE</option>
        		    @foreach($stores as $store)
                  <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
                </select>
              </div>
            <div class="col-md-4">
                <label class="form-label">Ref #:</label>
                <input type="text" id="txt-ref" class="form-control dt-input" 
                placeholder="Add Purchase Bill No" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Date:</label>
                <input type="date" id="fp-default" class="form-control" placeholder="YYYY-MM-DD" required/>
              </div>
            </div>
            <div class="row mb-md-1">
              <div class="col-md-12 mb-1">
                <label class="form-label">Note:</label>
                <input type="text" id="txt-note" class="form-control" placeholder="Note...">
              </div>
            </div>
            <button type="submit" disabled style="display: none" aria-hidden="true"></button>
            <div class="row mb-md-1">
              <div class="col-md-12 mb-1 d-grid">
                <button class="btn btn-primary" type="submit">COMPLETE PURCHASE</button>
              </div>
            </div>
        </form>
        </div>       
      </div>
    </div>
</div>

@push('custom-scripts')
<script>

let totalToPay = 0
let discount = 0

function calculateTotal(){
  discount = $('#purchase-discount').val()
  if(discount==="") discount=0;
  totalToPay = cartLS.total() - discount
  $('#after-discount').val(Number(totalToPay).toLocaleString())
}

function openPurchaseModal(){
  if(cartVerify()){
    calculateTotal()
    $('#modal-purchase').modal('show')
    $('#purchase-total').val(Number(cartLS.total()).toLocaleString())
  }
}

$("#purchase-discount").on('keyup', function (e) {

  if ((e.key === 'Enter' || e.keyCode === 13)) {
    calculateTotal()
  }

})

$( "#frm-purchase" ).submit(function( event ) {
  event.preventDefault()
  $.post( 
  "{{route('store-purchase')}}", 
  {
    _token: CSRF_TOKEN,
    contact_id: $('#cmb-contact').val(), 
    store_id: $('#cmb-store').val(),
    reference: $('#txt-ref').val(),
    purchase_date: $('#fp-default').val(),
    note: $('#txt-note').val(),
    total: totalToPay,
    discount: discount,
    cart:JSON.stringify(cartLS.list())
  }).done(function( result ){
      if(result.type=="success"){
        cartLS.destroy()
        confirmedMessage()
        $('#modal-purchase').modal('hide')
        showCart()
      }
  })
})

</script>
@endpush
