<?php

namespace App\Http\Livewire\Payments;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Contact;
use Illuminate\Http\Request;

class PaymentsModal extends Component
{
    public $payment;
    public $contact, $store_id;
    protected $listeners = ['setAttributes'];
    

    protected $rules=[
        'payment.amount'=>'required',
        'payment.payment_type'=>'required',
        'payment.reference_id'=>'nullable',
        'payment.contact_id'=>'required',
        'payment.is_sale'=>'nullable',
        'payment.cheque_date'=>'nullable',
        'payment.cheque_type'=>'nullable',
        'payment.bankname'=>'nullable',
        'payment.cheque_no'=>'nullable',
    ];

    public function mount(Request $request){
        $this->payment = new Payment;
        $this->contact = new Contact;
        $this->payment->payment_type = 'cash';
        $this->store_id = $request->session()->get('store_id');
    }

    public function render()
    {
        return view('livewire.payments.payments-modal');
    }

    public function save(){
        // $contact = Contact::find($this->payment->contact_id);
        // $contact->decrement("balance",$this->payment->amount);
        // $this->payment->is_sale = !$contact->is_supplier;
        if($this->payment->payment_type=="cheque") $this->payment->cheque_status="Pending";
        $this->payment->store_id=$this->store_id;
        $this->contact->increment('balance',$this->payment->amount);
        $this->payment->save();
        $this->payment = new Payment;
        $this->contact = new Contact;
        $this->payment->payment_type = 'cash';
        $this->emit('showMessage','Successfully added');
    }

    public function setAttributes($contact_id, $reference_id){
        $this->payment->contact_id = $contact_id;
        $this->payment->reference_id = $reference_id;
        $this->contact = Contact::find($contact_id);
        $this->payment->is_sale = !$this->contact->is_supplier;
    }
}
