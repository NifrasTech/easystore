<div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modal-store">
  <div class="modal-dialog">
    <form wire:submit.prevent="store" class="modal-content pt-0" method="POST">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">Store Details</h5>
      </div>
      <div class="modal-body flex-grow-1">
        @CSRF
        <div class="mb-1">
          <label class="form-label">Code</label>
          <input
            type="text"
            class="form-control"
            placeholder="Code..."
            wire:model.defer="store.code"
          />
          <span class="text-danger">
            @error('store.code') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="store Name"
            wire:model.defer="store.name"
          />
          <span class="text-danger">
            @error('store.name') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Contact</label>
          <input
            type="text"
            class="form-control"
            placeholder="Contact"
            wire:model.defer="store.contact"
          />
          <span class="text-danger">
            @error('store.contact') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            placeholder="store Name"
            wire:model.defer="store.email"
          />
          <span class="text-danger">
            @error('store.email') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Address</label>
          <textarea 
          id="" 
          cols="30" rows="5" 
          class="form-control"
          wire:model.defer="store.address">
          </textarea>
          <span class="text-danger">
            @error('store.address') {{ $message }} @enderror
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