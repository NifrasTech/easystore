<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\UserRole;

class RoleModal extends Component
{
    public $permissions = [];
    public $chk_permission = [];
    public $role;
    public $user_role;

    protected $listeners = ["findRole"];

    public function render()
    {
        return view('livewire.users.role-modal');
    }

    public function mount($permissions){
        $this->permissions = $permissions;
        $this->chk_permission = [];
        $this->role = "";
        $this->user_role = new UserRole;
    }

    public function store(){
        $this->user_role->role = $this->role;
        $this->user_role->permission = implode(',',array_filter($this->chk_permission));
        $this->user_role->save();
        $this->user_role = new UserRole;
        $this->chk_permission = [];
        $this->role = "";
    }

    public function findRole($id){
        $this->user_role = UserRole::find($id);
        $this->role = $this->user_role->role;
        $this->chk_permission = explode(',',$this->user_role->permission);
    }
}
