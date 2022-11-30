<div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modal-user">
      <div class="modal-dialog">
        <form wire:submit.prevent="store" class="add-new-user modal-content pt-0" method="POST">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title">Add/Edit User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="mb-1">
              @CSRF
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input
                type="text"
                class="form-control dt-full-name"
                placeholder="John Doe"
                name="user-fullname"
                wire:model.defer="users.name"
              />
              <span class="text-danger">
            @error('users.name') {{ $message }} @enderror
          </span>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-uname">Username</label>
              <input
                type="text"
                id="basic-icon-default-uname"
                class="form-control dt-uname"
                placeholder="Web Developer"
                name="user-name"
                wire:model.defer="users.username"
              />
              <span class="text-danger">
            @error('users.username') {{ $message }} @enderror
          </span>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input
                type="text"
                id="basic-icon-default-email"
                class="form-control dt-email"
                placeholder="john.doe@example.com"
                wire:model.defer="users.email"
              />
              <span class="text-danger">
            @error('users.email') {{ $message }} @enderror
          </span>
            </div>

            @if($users->id == null)
            <div class="mb-1">
              <label class="form-label">Password</label>
              <input
                type="text"
                class="form-control"
                placeholder="Password"
                name="user-password"
                wire:model.defer="users.password"
                required
              />
              <span class="text-danger">
            @error('users.password') {{ $message }} @enderror
          </span>
            </div>
            @endif

            <div class="mb-1">
              <label class="form-label" for="user-role">User Role</label>
              <select 
              id="user-role" 
              class="select2 form-select"
              wire:model.defer="users.role_id"
              >
                <option value="">Select User Role</option>
                @foreach($user_roles as $user_role)
                <option value="{{$user_role->id}}">{{$user_role->role}}</option>
                @endforeach
              </select>
              <span class="text-danger">
            @error('users.role_id') {{ $message }} @enderror
          </span>
            </div>

            <div class="mb-1">
              <label class="form-label" for="user-role">Assign Store</label>
              <select 
              id="user-store" class="form-select"
              wire:model.defer="users.store_id"
              >
                <option value="">Select A Store</option>
                @foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
              </select>
              <span class="text-danger">
            @error('users.store_id') {{ 'Please assign a store' }} @enderror
          </span>
            </div>
            <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>