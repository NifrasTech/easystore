<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Sale;
use App\Models\Payment;
use App\Models\Purchase;

class ContactDetails extends Component
{
    public $payments, $transaction, $contact_id, $dtStart, $dtEnd,$is_supplier;
    protected $listeners = ['initContact'];
    public function render()
    {
        return view('livewire.contact-details');
    }

    public function mount(){
        $this->transaction = new Sale;
        $this->payments = new Payment;
        $this->contact_id = 0;
        $this->dtEnd = NULL;
        $this->dtStart = NULL;
        $this->is_supplier = false;
    }

    public function initContact($id){
        $contact = Contact::find($id);
        if(!$contact->is_supplier){
            $this->transaction = Sale::where('contact_id',$id)->latest()->take(10)->get();
        }
        else $this->transaction = Purchase::where('contact_id',$id)->latest()->take(10)->get();
        
        $this->payments = Payment::where('contact_id',$id)->latest()->take(10)->get();
        $this->contact_id = $id;
        $this->is_supplier = $contact->is_supplier;
    }

    public function filter(){
        $this->sales = Sale::query();
        $this->payments = Payment::query();

        if(!empty($this->dtStart) && !empty($this->dtEnd))
        {
            $qry = 'sales.created_at';
            if($this->is_sppier) $qry = 'purchases.purchase_date';
            $this->payments = $this->payments->whereBetween('payments.created_at',
                [$this->dtStart.' 00:00:00', $this->dtEnd.' 23:59:59']
            );
            $this->transaction = $this->transaction->whereBetween($qry,
                [$this->dtStart.' 00:00:00', $this->dtEnd.' 23:59:59']
            );

            $this->transaction = $this->transaction->where('contact_id',$this->contact_id)->orderBy('id', 'DESC')->get();
            $this->payments = $this->payments->where('contact_id',$this->contact_id)->orderBy('id', 'DESC')->get();
        }
        else
        {
            $this->initContact($this->contact_id);
        }

    }
}
