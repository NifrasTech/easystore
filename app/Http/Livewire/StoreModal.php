<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Store;

class StoreModal extends Component
{
    public $store;
    protected $rules=[
        'store.name'=>'required',
        'store.code'=>'required',
        'store.address'=>'required',
        'store.email'=>'required',
        'store.contact'=>'required',
    ];
    protected $listeners = ['findStore','newStore'];
    public function render()
    {
        return view('livewire.store-modal');
    }

    public function mount(){
        $this->store = new Store;
    }

    public function newStore(){
        $this->store = new Store;
    }

    public function findStore($id){
        $this->store=Store::find($id);
    }

    public function store(){
        $this->validate();
        $this->store->save();
        $this->emit('showMessage','Successfully Completed');
    }
}
