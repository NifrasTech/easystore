<div wire:ignore.self class="modal image-modal fade" id="modal-expense">
  <div class="modal-dialog modal-dialog-centered">
    <form wire:submit.prevent="store" class="modal-content pt-0" id="image-form" method="POST" enctype="multipart/form-data">
      <div class="modal-header mb-1"> 
        <h5 class="modal-title">Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
      </div>
      <div class="modal-body flex-grow-1">
        @CSRF
 
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
                <input 
                type="date" class="form-control"  
                wire:model.defer="expense.expense_date" 
                required/>
                <span class="text-danger">
                    @error('expense.expense_date') {{ $message }} @enderror
                </span>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <input 
                type="text" class="form-control" placeholder="Description"
                wire:model.defer="expense.description"
                required/>
                <span class="text-danger">
                    @error('expense.description') {{ $message }} @enderror
                </span>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Amount</label>
            <div class="col-sm-9">
                <input 
                type="number"
                step="0.01" 
                class="form-control" placeholder="Amount" 
                wire:model.defer="expense.amount"
                required/>
                <span class="text-danger">
                    @error('expense.amount') {{ $message }} @enderror
                </span>
            </div>
        </div>
<div class="col-12 text-end">
        <button type="submit" class="btn btn-primary mt-1 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>