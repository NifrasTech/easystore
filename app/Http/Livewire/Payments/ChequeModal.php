<?php

namespace App\Http\Livewire\Payments;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Contact;

class ChequeModal extends Component
{
    public $payment;
    protected $listeners = ['findCheque'];

    protected $rules=[
        'payment.bankname'=>'required',        
        'payment.cheque_no'=>'required',        
        'payment.cheque_status'=>'required',        
        'payment.amount'=>'required',        
        'payment.note'=>'nullable',
        'payment.cheque_date'=>'required',       
        'payment.cheque_type'=>'required'       
    ];

    public function render()
    {
        return view('livewire.payments.cheque-modal');
    }

    public function mount(){
        $this->payment = new Payment;
        $this->pay_id=0;
    }

    public function findCheque($id){
        $this->payment = Payment::find($id);
    }

    public function updateCheque(){
        $this->validate();
        $cheque = Payment::find($this->payment->id);
        if($cheque->cheque_status != 'Cancelled' && $this->payment->cheque_status == "Cancelled"){
           Contact::find($cheque->contact_id)->decrement('balance',$cheque->amount);
        }
        else if($cheque->cheque_status == 'Cancelled' && $this->payment->cheque_status != "Cancelled"){
            Contact::find($cheque->contact_id)->increment('balance',$cheque->amount);
        }
        $this->payment->save();
        $this->emit('showMessage','Successfully added');
    }

}
