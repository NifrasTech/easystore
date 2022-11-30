
<div wire:ignore.self class="modal fade" id="modal-role" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-5 pb-5">
        <div class="text-center mb-4">
          <h1 class="role-title">Add New Role</h1>
          <p>Set role permissions</p>
        </div>
        <form wire:submit.prevent="store" class="row">
          <div class="col-12">
            <label class="form-label" for="modalRoleName">Role Name</label>
            <input
              type="text"
              name="modalRoleName"
              class="form-control"
              placeholder="Enter role name"
              tabindex="-1"
              wire:model.defer="role"
              required
            />
          </div>
          <div class="col-12">
            <h4 class="mt-2 pt-50">Role Permissions</h4>
            <!-- Permission table -->
                <div class="flex-wrap">
                @foreach ($permissions as $key=>$permission)  
                  <input type="checkbox" 
                  class="btn-check" 
                  value="{{$permission}}" 
                  wire:model.defer="chk_permission" 
                  id="{{$permission}}"
                  autocomplete="off">
                  <label 
                  class="btn btn-outline-primary mb-2 me-1" 
                  for="{{$permission}}">
                  {{strtoupper($permission)}}
                  </label>          
                @endforeach   
                </div>         
          </div>
          <div class="col-12 text-center mt-2">
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
