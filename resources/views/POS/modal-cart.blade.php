
<div class="modal fade" id="modal-cart">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content pt-0">
      <div class="modal-header mb-1"> 
        <h5 class="modal-title">Edit Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
      </div>
      <div class="modal-body flex-grow-1">    
        <div class="mb-1 row">
            @if(Route::is('point-of-sale'))
            <label for="colFormLabel" class="col-sm-3 col-form-label">Price</label>
            @else <label for="colFormLabel" class="col-sm-3 col-form-label">Cost</label>
            @endif

            <div class="col-sm-9">
                <input type="number" id="txtCartPrice" step="0.01" class="form-control" placeholder="Price"/>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Discount</label>
            <div class="col-sm-9">
                <input type="number" id="txtCartDiscount" step="0.01" value="0" class="form-control" placeholder="Discount" disabled/>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Note</label>
            <div class="col-sm-9">
                <input type="text" id="txtCartNote" class="form-control" placeholder="Note" required/>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-1 me-1 data-submit" onclick="updateCart()">SAVE</button>
        <button type="submit" class="btn btn-danger mt-1 me-1 data-submit" onclick="removeCart()">REMOVE</button>
        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>