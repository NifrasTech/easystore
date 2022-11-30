<div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modal-category">
  <div class="modal-dialog">
    <form wire:submit.prevent="store" class="modal-content pt-0" method="POST">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">Category Details</h5>
      </div>
      <div class="modal-body flex-grow-1">
        @CSRF
        <div class="mb-1">
          <label class="form-label">Code</label>
          <input
            type="text"
            class="form-control"
            placeholder="Code..."
            name="code"
            wire:model.defer="category.code"
          />
          <span class="text-danger">
            @error('category.code') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="Category Name"
            name="name"
            wire:model.defer="category.name"
          />
          <span class="text-danger">
            @error('category.name') {{ $message }} @enderror
          </span>
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