<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsSummary extends Component
{
    public $products;

    public function render()
    {
        return view('livewire.products.products-summary');
    }

    public function getSummary(){
        $this->products = Product::selectRaw('count(id) as total')
                        ->selectRaw('sum(cost*quantity) as valuation')
                        ->selectRaw('sum(quantity) as quantity')->first();
        $this->products->alert = Product::whereRaw('alert_quantity > quantity')->count();
    }

    public function mount(){
        $this->getSummary();
    }
}
