<div wire:ignore.self class="modal fade" id="modal-cheque" tabindex="-1" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title">Cheque Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="tab-pane active">
        <form wire:submit.prevent="updateCheque" class="row gy-1 pt-75" onsubmit="return false">
          <div class="col-12 col-md-6">
            <label class="form-label">Cheque No</label>
            <input
              type="text"
              class="form-control"
              placeholder="Cheque No"
              wire:model.defer="payment.cheque_no"
            />
            <span class="text-danger">
            @error('payment.cheque_no') {{ $message }} @enderror
          </span>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Bank</label>
            <input
              type="text"
              class="form-control"
              placeholder="Bank"
              wire:model.defer="payment.bankname"
            />
            <span class="text-danger">
            @error('payment.bankname') {{ $message }} @enderror
          </span>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Status</label>
            <select wire:model.defer="payment.cheque_status" class="form-control">
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            <span class="text-danger">
            @error('payment.cheque_status') {{ $message }} @enderror
            </span>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Amount</label>
            <input
              type="text"
              step="0.1"
              class="form-control"
              placeholder="Amount"
              wire:model.defer="payment.amount"
              readonly
            />
            <span class="text-danger">
            @error('payment.amount') {{ $message }} @enderror
          </span>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" >Cheque Date </label>
            <input
              type="date"
              class="form-control"
              placeholder="Cheque Date"
              wire:model.defer="payment.cheque_date"
            />
            <span class="text-danger">
            @error('payment.cheque_date') {{ $message }} @enderror
            </span>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" >Cheque Type </label>
            <input
              type="text"
              class="form-control"
              placeholder="Cheque Type"
              wire:model.defer="payment.cheque_type"
            />
            <span class="text-danger">
            @error('payment.cheque_type') {{ $message }} @enderror
            </span>
          </div>
          <div class="col-12">
            <label class="form-label" >Note </label>
            <input
              type="text"
              class="form-control"
              placeholder="Description..."
              wire:model.defer="payment.note"
            />
            <span class="text-danger">
            @error('payment.note') {{ $message }} @enderror
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

        
      </div>
    </div>
  </div>
</div>
