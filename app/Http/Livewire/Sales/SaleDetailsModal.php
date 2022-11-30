<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use App\Models\SaleItem;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Product;
use App\Models\StoreProduct;
use App\Models\Contact;
use Illuminate\Http\Request;

class SaleDetailsModal extends Component
{
    public $payments, $saleitems, $sale, $routeName;

    protected $listeners = ['initSale','removeItem'];
    protected $rules = ['sale.discount'=>'required','sale.reference'=>'nullable','sale.note'=>'nullable'];
    public function render()
    {
        return view('livewire.sales.sale-details-modal');
    }

    public function mount(Request $request){
        $this->payments=$this->saleitems=$this->sale = null;
        $this->routeName = $request->route()->getName();
    }

    public function initSale($saleID){
        $this->saleitems = SaleItem::joined()->where('sale_id',$saleID)->orderBy('id', 'DESC')->get();
        $this->sale = Sale::find($saleID);
        $this->payments = Payment::where('reference_id',$saleID)->orderBy('id', 'DESC')->where('is_sale',1)->get();
    }

    public function removeItem($id){
        $saleItem = SaleItem::find($id);
        $sale = Sale::find($saleItem->sale_id);
        Product::where('id',$saleItem->product_id)->increment('quantity',$saleItem->quantity);
        StoreProduct::where('product_id',$saleItem->product_id)
                        ->where('store_id',$sale->store_id)
                        ->increment('quantity',$saleItem->quantity);
        $itemTotal = ($saleItem->price-$saleItem->discount)*$saleItem->quantity;
        $itemProfit = ($saleItem->price-$saleItem->cost)*$saleItem->quantity;
        $sale->total = $sale->total-$itemTotal;
        $sale->profit = $sale->total-$itemProfit;
        $sale->save();
        Contact::find($sale->contact_id)->increment('balance',$itemTotal);
        $saleItem->delete();
        $this->initSale($saleItem->sale_id);
        $this->emit('removedMessage','Successfully Removed');
    }

    public function updateSale(){
        // $sale = Sale::find($this->sale->id);
        Contact::find($this->sale->contact_id)->increment('balance',$this->sale->total);
        $this->sale->total = ($this->sale->total + $this->sale->getOriginal('discount'))-$this->sale->discount;
        Contact::find($this->sale->contact_id)->decrement('balance',$this->sale->total);
        $this->sale->save();
        $this->initSale($this->sale->id);
    }
}
