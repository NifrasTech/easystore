<div class="modal fade" id="modal-transfer" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title">TRANSFER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="" id="frm-transfer" method="POST">
        <div class="row mb-md-1">

            <div class="col-md-6">
                <label class="form-label">FROM</label>
                <select 
                    class="select2 form-select text-capitalize mb-md-0 mb-2"
                    id="cmb-fromstore">
                <option value="">SELECT A STORE</option>
        		@foreach($stores as $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
                </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">TO</label>
                <select 
          class="select2 form-select text-capitalize mb-md-0 mb-2"
          id="cmb-tostore">
                <option value="">SELECT A STORE</option>
        		@foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-md-1">
              <div class="col-md-4 mb-1">
              <label class="form-label">Transfer Total :</label>
                <input type="text" class="form-control fs-4 fw-bold" id="transfer-total" readonly>
              </div>

              <div class="col-md-4">
                <label class="form-label">Ref #:</label>
                <input type="text" id="txt-ref" class="form-control dt-input" 
                placeholder="Reference" required>
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
                <button class="btn btn-primary" type="submit">TRANSFER</button>
              </div>
            </div>
        </form>
        </div>       
      </div>
    </div>
</div>

@push('custom-scripts')
<script>

let transTotal = 0

function calculateTotal(){
  transTotal = cartLS.total()
  $('#after-discount').val(Number(transTotal).toLocaleString())
}

function openTransferModal(){
  if ((cartLS.list()).length==0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Cart is Empty',
      scrollbarPadding: false,
      heightAuto: false, 
    })
  }
  else{
    calculateTotal()
    $('#modal-transfer').modal('show')
    $('#transfer-total').val(Number(cartLS.total()).toLocaleString())
  }
}

$( "#frm-transfer" ).submit(function( event ) {
  event.preventDefault()
  let from = $('#cmb-fromstore').val()
  let to = $('#cmb-tostore').val()

  if(from==to) toastMessage("Store cannot be same",'error','Error')
  else{
        $.post( 
        "{{route('store-transfer')}}", 
        {
            _token: CSRF_TOKEN,
            transfer_date: $('#fp-default').val(),
            from_store: from,
            to_store: to,
            reference: $('#txt-ref').val(),
            note: $('#txt-note').val(),
            cost: transTotal,
            cart:JSON.stringify(cartLS.list())
        }).done(function( result ){
            if(result.type=="success"){
                cartLS.destroy()
                confirmedMessage()
                $('#modal-transfer').modal('hide')
                showCart()
            }
            else if(result.type=="error"){
                toastMessage(result.message,'error','Error')
            }
        })
    }
})

</script>
@endpush
