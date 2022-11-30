<div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modal-contact">
  <div class="modal-dialog">
    <form wire:submit.prevent="store" class="modal-content pt-0" method="POST">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">Contact Details</h5>
      </div>
      <div class="modal-body flex-grow-1">
        @CSRF
        <div class="mb-1">
          <label class="form-label">Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="Name..."
            wire:model.defer="contact.name"
          />
          <span class="text-danger">
            @error('contact.name') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Contact No</label>
          <input
            type="text"
            class="form-control"
            placeholder="Contact No"
            wire:model.defer="contact.contact_no"
          />
          <span class="text-danger">
            @error('contact.contact_no') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            placeholder="example@email.com"
            wire:model.defer="contact.email"
          />
          <span class="text-danger">
            @error('contact.email') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">City</label>
          <input
            type="text"
            class="form-control"
            placeholder="City"
            wire:model.defer="contact.city"
          />
          <span class="text-danger">
            @error('contact.city') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Address</label>
          <textarea
            class="form-control"
            placeholder="Address"
            wire:model.defer="contact.address"
          >
          </textarea>
          <span class="text-danger">
            @error('contact.address') {{ $message }} @enderror
          </span>
        </div>
        <div class="mb-1">
          <label class="form-label">Description</label>
          <textarea
            class="form-control"
            placeholder="Description"
            wire:model.defer="contact.description"
          >
          </textarea>
          <span class="text-danger">
            @error('contact.description') {{ $message }} @enderror
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