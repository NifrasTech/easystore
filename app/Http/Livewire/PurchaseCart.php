<?php

namespace App\Http\Livewire;
use \Illuminate\Session\SessionManager;
use Livewire\Component;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseCart extends Component
{
    public $cart=[];
    public $quantity;
    public $discount;
    public $grandtotal;
    protected $listeners = ['addToCart','clearCart','updateDiscount'];

    public function render()
    {
        return view('livewire.purchase-cart');
    }

    public function mount(SessionManager $session){
        // $session->forget('cart');
        $this->cart = $session->get('cart');
        $this->grandtotal = 0;
        $this->discount = 0;
    }

    public function addToCart($id){

        $cart = session()->get('cart');
        $product = Product::find($id);
        if(!$cart)
    	{
    		$cart[$id]=[
    			"name"=>$product->name,
    			"quantity"=>1,
    			"price"=>$product->price,
    			"discount"=>0,
    			"cost"=>$product->cost,
                "image"=>$product->image,
    					 ];
    	}
        // if cart not empty then check if this product exist then increment quantity
        else if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }
        else{

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "discount"=>0,
                "cost"=>$product->cost,
                "image"=>$product->image,
            ];
        }

        session()->put('cart', $cart);
        $this->cart = session()->get('cart');
    }

    public function removeFromCart($id){
        $cart = session()->get('cart');
		if(isset($cart[$id])) 
		{
	        unset($cart[$id]);
	        session()->put('cart', $cart);    
        }
        $this->cart = session()->get('cart');
    }

    public function clearCart(){
        session()->forget('cart');
        $this->cart = session()->get('cart');
    }

    //Update Cart ($updatevalue, $cartID, cost || quantity || price)
    public function updateCart($value, $id, $type){
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id][$type]=$value;
            session()->put('cart', $cart);
            $this->cart = session()->get('cart');
            $this->emit('showMessage',ucfirst($type).' Updated');
        }
    }

    public function updateDiscount($discount){
        $this->discount = $discount;
        $this->emit('showMessage','Discount applied');
    }  
}
