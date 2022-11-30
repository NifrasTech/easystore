<div wire:ignore.self class="modal fade" id="modal-payment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-2 px-sm-2 pt-30">
        <div class="text-center mb-2">
          <h1 class="mb-1">ADD PAYMENT</h1>
        </div>
        <form id="form-payment" class="row gy-1 pt-75" wire:submit.prevent="save">
          @CSRF
          <div class="col-12 text-center">
            <label class="form-label" >Amount</label>
            <input
              type="number"
              class="form-control"
              placeholder="0"
              wire:model.defer = "payment.amount"
              required
            />
          </div>

          <div class="btn-group" role="group">
                <input type="radio" class="btn-check" 
                wire:model="payment.payment_type" 
                name="payment-type" id="cash" 
                value="cash" autocomplete="off" checked />
                <label class="btn btn-outline-primary" for="cash">CASH</label>

                <input type="radio" class="btn-check" 
                wire:model="payment.payment_type" 
                name="payment-type" id="cheque" 
                value="cheque" autocomplete="off" />
                <label class="btn btn-outline-primary" for="cheque">CHEQUE</label>
                <input type="radio" class="btn-check" 
                
                wire:model="payment.payment_type" 
                name="payment-type" id="other" 
                value="other" autocomplete="off" />
                <label class="btn btn-outline-primary" for="other">OTHER</label>
              </div>

          <div class="col-12">
            <label class="form-label">Note</label>
            <input
              type="text"
              class="form-control"
              placeholder="Note..."
              wire:model.defer = "payment.note"
            />

            @if($payment->payment_type=="cheque")
          </div>
            <div class="col-12 col-sm-6 cheque">
            <label class="form-label">Cheque No</label>
            <input
              type="text"
              class="form-control"
              placeholder="Cheque Number..."
              wire:model.defer = "payment.cheque_no"
              required
            />
            </div>
            <div class="col-12 col-sm-6 cheque">
            <label class="form-label">Bank</label>
            <input
              type="text"
              class="form-control"
              placeholder="Bank Name"
              wire:model.defer = "payment.bankname"
              required
            />
            </div>
            <div class="col-12 col-sm-6 cheque">
            <label class="form-label">Date</label>
            <input
              type="date"
              class="form-control"
              placeholder="Date of cheque"
              wire:model.defer = "payment.cheque_date"
              required
            />
            </div>
            <div class="col-12 col-sm-6 cheque">
            <label class="form-label">Cheque Type</label>
            <select name="" id="" 
            wire:model.defer = "payment.cheque_type"
            class="form-select form-control"
            required>
              <option value="">Select a Type</option>
              <option value="cash">Cash Cheque</option>
              <option value="dated">Dated Cheque</option>
            </select>
            </div>
            @endif
        
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
