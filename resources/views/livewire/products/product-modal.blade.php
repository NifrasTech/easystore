<div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modal-product">
  <div class="modal-dialog">
    <form wire:submit.prevent="store" class="modal-content pt-0" method="POST">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">Product Details</h5>
      </div>
      <div class="modal-body flex-grow-1">
        @CSRF
        <div class="mb-1">
          <label class="form-label">Barcode</label>
          <input
            type="text"
            class="form-control"
            placeholder="000012150000"
            name="barcode"
            wire:model.defer="product.barcode"
          />
          <span class="error">
            @error('product.barcode') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="Product Name"
            name="name"
            wire:model.defer="product.name"
          />
          <span class="error">
            @error('product.name') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Price</label>
          <input
            type="number"
            class="form-control"
            placeholder="Price..."
            name="price"
            wire:model.defer="product.price"
          />
          <span class="error">
            @error('product.price') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Cost</label>
          <input
            type="number"
            class="form-control dt-contact"
            name="cost"
            placeholder="Cost..."
            wire:model.defer="product.cost"
          />
          <span class="error">
            @error('product.cost') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Alert Qty.</label>
          <input
            type="number"
            class="form-control dt-contact"
            name="alert_quantity"
            wire:model.defer="product.alert_quantity"
          />
          <span class="error">
            @error('product.alert_quantity') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Unit Type</label>
          <input
            type="text"
            class="form-control dt-contact"
            name="unit_type"
            wire:model.defer="product.unit_type"
          />
          <span class="error">
            @error('product.unit_type') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Category</label>
          <select class="select2 form-select product-select2" wire:model.defer="product.category_id">
            <option value="">Select a Category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
          <span class="error">
            @error('product.category_id') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label" name="brand">Brand</label>
          <select class="select2 form-select product-select2" wire:model.defer="product.brand_id">
          <option value="">Select a Brand</option>
            @foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-1">
          <label class="form-label">Featured Item</label>
          <select class="form-select" wire:model.defer="product.is_featured">
            <option value="1">Yes</option>
            <option value="0" selected>No</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <div wire:loading>

        Processing...

        </div>
      </div>
    </form>
  </div>
</div>