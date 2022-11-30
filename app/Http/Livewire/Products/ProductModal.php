<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductModal extends Component
{
    public $product,$brands,$categories,$auth;
    protected $listeners = ['findProduct'];

    protected $rules=[
        'product.name'=>'required',
        'product.barcode'=>'required',
        'product.cost'=>'required',
        'product.price'=>'required',
        'product.alert_quantity'=>'required',
        'product.unit_type'=>'required',
        'product.category_id'=>'required',
        'product.brand_id'=>'nullable',
        'product.created_by'=>'nullable',
        'product.is_featured'=>'required',
    ];

    public function mount(Request $request){
        $this->product = new Product;
        $this->product->barcode = Product::count()+1;
        $this->brands = Brand::all();
        $this->categories = Category::all();
        $this->auth = $request->user()->id;
        $this->product->is_featured = 0;
    }

    public function render()
    {
        return view('livewire.products.product-modal');
    }

    public function findProduct($id){
        $this->product = Product::find($id);
    }

    public function store()
    {
        // code...
        $this->product['created_by'] = $this->auth;
        $this->validate();
        $this->product->save();
        $this->product = new Product;

        //Show Message (this function is from Javascript - product.js)
        $this->emit('showMessage','Successfully added');
    }
}
