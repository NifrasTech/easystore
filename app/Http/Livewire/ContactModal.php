<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class ContactModal extends Component
{
    public $contact;
    public $is_supplier;
    protected $listeners = ['findContact','setType'];

    protected $rules=[
        'contact.name'=>'required',        
        'contact.contact_no'=>'required',        
        'contact.email'=>'nullable',        
        'contact.city'=>'required',        
        'contact.address'=>'required',        
        'contact.description'=>'nullable',        
    ];

    public function render()
    {
        return view('livewire.contact-modal');
    }

    public function mount(){
        $this->is_supplier = false;
        $this->contact = new Contact;
    }

    public function setType($type){
        if($type=="customer") $this->is_supplier=false;
        else if ($type=="vendor") $this->is_supplier=true;
        $this->contact = new Contact;
    }

    public function findContact($id){
        $this->contact = Contact::find($id);
    }

    public function store(){
        $this->validate();
        $this->contact->is_supplier = $this->is_supplier;
        $this->contact->save();
        $this->contact = new Contact;

        //Show Message (this function is from Javascript - product.js)
        $this->emit('showMessage','Successfully added');
    }

}
