<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PurchaseItem;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Contact;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class PurchaseDetailsModal extends Component
{
    public $payments, $purchItems, $purchase, $purchDate;

    protected $rules = ['purchase.discount'=>'required','purchase.reference'=>'required',
    'purchase.purchase_date'=>'required','purchase.note'=>'nullable','purchDate'=>'required'];
    protected $listeners = ['initPurchase','removeItem'];
    public function render()
    {
        return view('livewire.purchase-details-modal');
    }

    public function mount(Request $request){
        $this->payments=$this->purchItems=$this->sale = $this->purchDate=null;
    }

    public function initPurchase($purchaseID){
        $this->purchItems = PurchaseItem::joined()->where('purchase_id',$purchaseID)->orderBy('id', 'DESC')->get();
        $this->purchase = Purchase::find($purchaseID);
        $this->payments = Payment::where('reference_id',$purchaseID)->orderBy('id', 'DESC')->where('is_sale',0)->get();
        $this->purchase->purchase_date = $this->purchase->purchase_date->format('Y-m-d');
        $this->purchDate = $this->purchase->purchase_date->format('Y-m-d');
    }

    public function removeItem($id){
        $purchItems = PurchaseItem::find($id);
        $purchase = Purchase::find($purchItems->purchase_id);
        Product::where('id',$purchItems->product_id)->decrement('quantity',$purchItems->quantity);
        StoreProduct::where('product_id',$purchItems->product_id)
                        ->where('store_id',$purchase->store_id)
                        ->decrement('quantity',$purchItems->quantity);
        $itemTotal = ($purchItems->cost-$purchItems->discount)*$purchItems->quantity;
        $purchase->total = $purchase->total-$itemTotal;
        $purchase->save();
        Contact::find($purchase->contact_id)->increment('balance',$itemTotal);
        $purchItems->delete();
        $this->initPurchase($purchItems->purchase_id);
        $this->emit('removedMessage','Successfully Removed');
    }

    public function updatePurchase(){
        $this->purchase->purchase_date = $this->purchDate;
        $this->validate();
        Contact::find($this->purchase->contact_id)->increment('balance',$this->purchase->total);
        $this->purchase->total = ($this->purchase->total + $this->purchase->getOriginal('discount'))-$this->purchase->discount;
        Contact::find($this->purchase->contact_id)->decrement('balance',$this->purchase->total);
        $this->purchase->save();
        $this->initPurchase($this->purchase->id);
    }
}
