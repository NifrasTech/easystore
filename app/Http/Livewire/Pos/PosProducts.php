<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;
use App\Models\Product;

class PosProducts extends Component
{
    public $times=1;
    public $products;
    public $search_product;
    public $some="";
    protected $listeners = ['searchProducts'];

    public function mount(){
       $this->products = Product::joined()->where('is_featured',1)->get(); 
    }

    public function render()
    {
        return view('livewire.pos.pos-products');
    }

    public function times($times=1){
        $this->times = $times;
    }

    public function searchProducts($search,$search_method){
        if($search_method=="barcode")
        {

         $this->products = Product::joined()->where('barcode', 'LIKE', $search.'%')
                             ->limit(50)
                             ->get();
        }
        else
        {
          $this->products = Product::joined()->where('products.name', 'LIKE', $search.'%')
                             ->limit(50)
                             ->get();
        }
    }
}
