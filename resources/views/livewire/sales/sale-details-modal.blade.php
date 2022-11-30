<div wire:key="modal-saledetails" wire:ignore.self class="modal fade" id="modal-saledetails" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title">Sale Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      @if(!empty($sale))
      <div class="row">
        <div class="col-md-4">
        <label>Bill Total:</label>
        
            <input type="text" value="{{number_format($sale->total+$sale->discount)}}" class="form-control mb-2" readonly/>

        </div>
        <div class="col-md-4">
        <label>Discount:</label>
            <input type="number" step="0.01" wire:model.defer="sale.discount" class="form-control mb-2"/>
        </div>
        <div class="col-md-4">
        <label>After Discount:</label>
            <input type="text" class="form-control mb-2" value="{{number_format($sale->total)}}" readonly/>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-4">
        <label>Reference:</label>
          <input type="text" wire:model.defer="sale.reference" class="form-control mb-2" id="">
        </div>
        <div class="col-md-4">
        <label>Note:</label>
          <input type="text" wire:model.defer="sale.note" class="form-control mb-2" id="">
        </div>
        <div class="col-md-4 d-grid"> 
          @if($sale->status=='Open') <button class="btn btn-primary" wire:click="updateSale">UPDATE</button>
          @else <button class="btn btn-primary" disabled>CLOSED</button>
          @endif
        </div>
      </div>
      @endif

        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="aboutIcon-tab"
                data-bs-toggle="tab"
                href="#sales-area"
                aria-controls="about"
                role="tab"
                aria-selected="false"
                ><i class="fas fa-cubes"></i>ITEMS</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                data-bs-toggle="tab"
                href="#payment-area"
                role="tab"
                aria-selected="true"
                ><i class="fas fa-plus-square"></i>PAYMENTS</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="sales-area" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Item</th>
                            <th>Qty.</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Disc</th>
                            <th>Total</th>
                            <th>Note</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if(!empty($saleitems))
                            @foreach ($saleitems as $item)
                            <tr>
                              <td style="padding: 0.3rem;">{{$item->name}}</td>
                              <td>{{$item->quantity}}</td>
                              <td>{{$item->cost}}</td>
                              <td>{{$item->price}}</td>
                              <td>{{$item->discount}}</td>
                              <td>{{number_format(($item->price - $item->discount)*$item->quantity)}}</td>
                              <td>{{$item->note}}</td>
                              <td> <a href="#" class="text-danger" onclick='removeItem({{$item->id}})'> <i class="fa fa-trash"></i> </a></td>
                              </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>    
            <div class="tab-pane" id="payment-area" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Note</th>
                        </thead>
                        <tbody>
                            @if(!empty($saleitems))
                            @foreach ($payments as $payment)
                            <tr>
                              <td>{{$payment->created_at}}</td>
                              <td>{{strtoupper($payment->payment_type)}}</td>
                              <td>{{number_format($payment->amount)}}</td>
                              <td>{{$payment->note}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>   
      </div>
    </div>
  </div>
</div>
</div>

@push('custom-scripts')
<script>
$(function (){
  window.livewire.on('removedMessage',message=>{
    toastMessage(message,'success','Done')
  })
})

function removeItem(id){
  Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to delete this item?",
          icon: 'warning',
          showCancelButton: true,
          scrollbarPadding: false,
          heightAuto: false, 
          confirmButtonText: 'Yes, Update',
          customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-outline-primary ms-1'
          },
          buttonsStyling: false
      }).then(function (result) {
          if(result.isConfirmed) 
          {
            window.livewire.emit('removeItem',id)
          }
      })
}
</script>
@endpush
