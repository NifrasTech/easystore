
<div wire:ignore.self class="modal fade" id="modal-stock" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title">Stock Adjustment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                data-bs-toggle="tab"
                href="#add-area"
                role="tab"
                aria-selected="true"
                ><i class="fas fa-plus-square"></i> ADD</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="aboutIcon-tab"
                data-bs-toggle="tab"
                href="#quantity-area"
                aria-controls="about"
                role="tab"
                aria-selected="false"
                ><i class="fas fa-cubes"></i> QUANTITY</a
              >
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="add-area" aria-labelledby="homeIcon-tab" role="tabpanel">
            <form wire:submit.prevent="updateStock" id="stock-form" class="row gy-1 pt-75" onsubmit="return false">
          <div class="col-12 col-md-6">
            <label class="form-label">Store</label>
            <select 
            class="form-select text-capitalize mb-md-0 mb-2"
            wire:model.defer="stock_adjustment.store_id"
            >
            <option value="">Select a store</option>
        	@foreach($stores as $store)
            <option value="{{$store->id}}">{{$store->name}}</option>
            @endforeach
        	</select>
            <span class="text-danger">
            @error('stock_adjustment.store_id') {{ $message }} @enderror
          </span>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Quantity</label>
            <input
              type="number"
              step="0.1"
              class="form-control"
              placeholder="Quantity"
              wire:model.defer="stock_adjustment.quantity"
            />
            <span class="text-danger">
            @error('stock_adjustment.quantity') {{ $message }} @enderror
          </span>
          </div>
          <div class="col-12">
            <label class="form-label" >Description</label>
            <input
              type="text"
              class="form-control"
              placeholder="Description..."
              wire:model.defer="stock_adjustment.description"
            />
            <span class="text-danger">
            @error('stock_adjustment.description') {{ $message }} @enderror
            </span>
          </div>
          
          <div class="col-12 text-center mt-2 pt-50">
            <button type="submit" class="btn btn-primary me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
              Discard
            </button>
          </div>
        </form>
            </div>
            <div class="tab-pane" id="quantity-area" role="tabpanel">
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                          <th>Store</th>
                          <th>Quantity</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                          @foreach($store_product as $store_product_)
                          @if(isset($store_product_->store_id))
                          <tr>
                              <td>{{$store_product_->name}}</td>
                              <td>{{$store_product_->quantity}}</td>
                          </tr>
                          @endif
                          @endforeach
                          <tfoot>
                            <tr>
                              <th></th>
                              <th>{{number_format($store_product->sum('quantity'))}}</th>
                            </tr>
                          </tfoot>
                      </tbody>
                  </table>
              </div>
         </div>

        
      </div>
    </div>
  </div>
</div>
</div>
