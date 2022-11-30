<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Illuminate\Session\SessionManager;
use App\Models\Product;

class TransferCart extends Component
{
    public $cart=[];
    public $quantity;
    public $grandtotal;
    protected $listeners = ['addToCart','clearCart'];

    public function render()
    {
        return view('livewire.transfer-cart');
    }

    public function mount(SessionManager $session){
        $this->cart = $session->get('transfer_cart');
        $this->grandtotal = 0;
    }

    public function addToCart($id){

        $cart = session()->get('transfer_cart');
        $product = Product::find($id);
        if(!$cart)
    	{
    		$cart[$id]=[
    			"name"=>$product->name,
    			"quantity"=>1,
    			"price"=>$product->price,
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
                "cost"=>$product->cost,
                "image"=>$product->image,
            ];
        }

        session()->put('transfer_cart', $cart);
        $this->cart = session()->get('transfer_cart');
    }

    public function removeFromCart($id){
        $cart = session()->get('transfer_cart');
		if(isset($cart[$id])) 
		{
	        unset($cart[$id]);
	        session()->put('transfer_cart', $cart);    
        }
        $this->cart = session()->get('transfer_cart');
    }

    public function clearCart(){
        session()->forget('transfer_cart');
        $this->cart = session()->get('transfer_cart');
    }

    //Update Cart ($updatevalue, $cartID, cost || quantity || price)
    public function updateCart($value, $id, $type){
        $cart = session()->get('transfer_cart');
        if(isset($cart[$id])) {
            $cart[$id][$type]=$value;
            session()->put('transfer_cart', $cart);
            $this->cart = session()->get('transfer_cart');
            $this->emit('showMessage',ucfirst($type).' Updated');
        }
    }
}
