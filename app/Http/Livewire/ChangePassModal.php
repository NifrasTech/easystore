<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePassModal extends Component
{
    public $oldpassword, $newpassword,$confirmpassword, $auth,$message, $success;

    public function render()
    {
        return view('livewire.change-pass-modal');
    }

    public function mount(Request $request){
        $this->success=$this->message=$this->oldpassword = $this->newpassword = $this->confirmpassword= "";
        $this->auth = $request->user();
    }

    public function store(){
        if(Hash::check($this->oldpassword, $this->auth->password)){
            if($this->newpassword != $this->confirmpassword){
                $this->message = "Confirm Password not matched!";
            }
            else{
                $this->auth->password=Hash::make($this->confirmpassword);
                $this->auth->save();
                $this->message = "";
                $this->success = "Password Changed Successfully";
            }
        } else 
        {
            $this->success = "";
            $this->message = "Old Password is Incorrect";
        }
    }
}
