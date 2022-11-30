<div wire:ignore.self class="modal image-modal fade" id="modal-changepassword">
  <div class="modal-dialog modal-dialog-centered">
    <form wire:submit.prevent="store" class="modal-content pt-0" method="POST" enctype="multipart/form-data">
      <div class="modal-header mb-1">  
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
      </div>
      <div class="modal-body flex-grow-1 px-2">
        @CSRF
        <div class="col-12">
            <label class="form-label" for="modalRoleName">Old Password</label>
            <input
              type="password"
              class="form-control mb-2"
              placeholder="Old Password"
              tabindex="-1"
              wire:model.defer="oldpassword"
              required
            />
          </div>            
        <div class="col-12">
            <label class="form-label" for="modalRoleName">New Password</label>
            <input
              type="password"
              class="form-control mb-2"
              placeholder="Enter New Password"
              tabindex="-1"
              wire:model.defer="newpassword"
              required
            />
          </div>
        <div class="col-12">
            <label class="form-label" for="modalRoleName">Confirm Password</label>
            <input
              type="password"
              class="form-control mb-2"
              placeholder="Enter Confirm Password"
              tabindex="-1"
              wire:model.defer="confirmpassword"
              required
            />
          </div>
          
          @if(!empty($message))
          <div class="col-12">
            <label class="form-label text-danger">{{$message}}</label>
          </div>
          @endif
          @if(!empty($success))
          <div class="col-12">
            <label class="form-label text-success">{{$success}}</label>
          </div>
          @endif
        </div>  

        <div class="col-12 text-end mt-2 mb-2 px-2">
            <button type="submit" class="btn btn-primary me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                Discard
            </button>
        </div>
      </div>
    </form>
  </div>