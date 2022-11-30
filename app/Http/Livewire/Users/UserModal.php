<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\UserRole;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;

class UserModal extends Component
{
    public $user_roles, $users, $stores, $userpassword;
    protected $listeners = ['findUser'];
    protected $rules=[
        'users.name' => 'required',
        'users.username' => ['required','unique:users'],
        'users.email' => 'required',
        'users.password' => 'nullable',
        'users.role_id' => 'required',
        'users.store_id' => 'required_unless:role_id,2',
    ];

    public function mount(){
        $this->user_roles = UserRole::where('id','!=','1')->get();
        $this->users = new User;
        $this->stores = Store::get();
    }

    public function render()
    {
        return view('livewire.users.user-modal');
    }

    public function findUser($id){
        $this->users = User::find($id);
        $this->userpassword = $this->users->password;
    }

    public function store(){
        if(empty($this->users->id)) $this->users->password = Hash::make($this->users->password);
        else $this->users->password = $this->userpassword;
        $this->validate();
        $this->users->save();
        $this->users = new User;

        $this->emit('showMessage','Successfully completed');
    }
}
