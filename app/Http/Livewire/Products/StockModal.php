<?php

namespace App\Http\Livewire\Products;
use Illuminate\Http\Request;

use Livewire\Component;
use App\Models\StockAdjustment;
use App\Models\StoreProduct;
use App\Models\Product;
use Auth;

class StockModal extends Component
{
    public $stores;
    public $stock_adjustment;
    public $store_product;
    public $product;
    public $user_id;

    protected $listeners = ['findStockProduct'];

    protected $rules=[
        'stock_adjustment.description'=>'required',      
        'stock_adjustment.quantity'=>'required|numeric',     
        'stock_adjustment.store_id'=>'required',     
    ];

    public function mount($stores){
        $this->stores = $stores;
        $this->stock_adjustment = new StockAdjustment;
        $this->store_product = new StoreProduct;
        $this->product = new Product;
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.products.stock-modal');
    }

    public function findStockProduct($id){
        $this->product = Product::find($id);

        $this->store_product = StoreProduct::joined()->where('product_id','=',$id)->get();
    }

    public function updateStock(){
        $this->validate();
        $this->stock_adjustment['product_id']=$this->product->id;
        $this->stock_adjustment['created_by']=$this->user_id;
        $this->stock_adjustment->save();
        $store_product = StoreProduct::firstOrCreate(
            ['store_id'=>$this->stock_adjustment->store_id,'product_id'=>$this->product->id]
        );

        //Update Store product quantity
        $store_product->increment('quantity',$this->stock_adjustment->quantity);
        //Update product quantity
        $this->product->increment('quantity',$this->stock_adjustment->quantity);
        //Get store product quantity
        $this->store_product = StoreProduct::joined()->where('product_id','=',$this->product->id)->get();

        $this->stock_adjustment = new StockAdjustment;

        //Show Message
        $this->emit('showMessage','Successfully added');
    }
}
