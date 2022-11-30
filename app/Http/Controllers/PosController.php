<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\StoreProduct;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Payment;
use App\Models\Contact;
use App\Models\SaleHold;
use App\Models\Store;

class PosController extends Controller
{
    //
public function gotoPos()
{
  $pageConfigs = ['blankPage' => true];
  $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Blank"]];
  $pageConfigs = ['blankPage' => true,'contentLayout' => "content-left-sidebar",
  'pageClass' => 'file-manager-application','showMenu' => false,];
  $stores = Store::all();
  return view('/POS/pos', compact('pageConfigs','breadcrumbs','stores'));
}

public function gotoEditSale($id){
  $pageConfigs = ['blankPage' => true];
  $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Blank"]];
  $pageConfigs = ['blankPage' => true,'contentLayout' => "content-left-sidebar",
  'pageClass' => 'file-manager-application','showMenu' => false,];

  //Check sale is available for edit and Open 
  $sale = Sale::where('status','Open')->where('id',$id)->first();
  
  if(!empty($sale)){
    $stores = Store::all();
    return view('/POS/pos', compact('pageConfigs','breadcrumbs','sale','stores'));
  }
  return redirect()->route('point-of-sale');
}

  public function gotoCheckout()
  {
    $pageConfigs = ['pageHeader' => false,'showMenu' => false,'pageClass' => 'ecommerce-application',];
    return view('/POS/checkout', ['pageConfigs' => $pageConfigs]);
  }

  public function productSearch(Request $request){
    //Implement a coding if empty search -> featured items
    $search = $request->search;

    if($request->search_method=="barcode")
    {

     $datas = Product::select('id','name','brand_id','barcode')
                         ->where('barcode', 'LIKE', $request->search.'%')
                         ->limit(10)
                         ->get();
    }
    else
    {
      $datas = Product::select('id','name','brand_id', 'barcode')
                         ->where('products.name', 'LIKE', $request->search.'%')
                         ->limit(10)
                         ->get();
    }

    $response = array();
    foreach($datas as $data){

    // if(!empty($data->brand_name)) $brand = ' | '.$data->brand_name;
    // else $brand = "";

    $response[] = array("value"=>$data->id,"label"=>$data->name.' | '.$data->barcode, "name"=>$data->name, "barcode"=>$data->barcode);
    }
    return response()->json($response);
  }

  public function checkout(Request $request){

    $cart = json_decode($request->input('cart'));
    $payments = json_decode($request->input('payments'));
    $contact_id = $request->input('contact');
    $store_id = $request->session()->get('store_id');
    $paid_amount = 0;
    $profit = 0;

    $sale = new Sale;
    $sale->contact_id = $contact_id;
    $sale->reference = $request->input('reference');
    $sale->total = $request->input('total') - $request->input('discount');
    $sale->discount = $request->input('discount');
    $sale->note = $request->input('note');
    
    $sale->store_id = $store_id;
    $sale->save();

    $sale_items = [];
    $payments_set = [];
    foreach($cart as $key=>$item){
      $sale_items[] = [
        'sale_id'=>$sale->id,
        'product_id'=>$item->id,
        'cost'=>$item->cost,
        'price'=>$item->price,
        'discount'=>$item->discount,
        'quantity'=>$item->quantity,
        'note'=>$item->note
      ];
      $profit+=($item->price-$item->cost)*$item->quantity;
      StoreProduct::where('product_id',$item->id)
                    ->where('store_id',$store_id)
                    ->decrement('quantity',$item->quantity);
      Product::find($item->id)->decrement('quantity',$item->quantity);
    }

    foreach($payments as $key=>$payment){
      
      //If the payment method is cheque then cheque status should be pending
      $cheque = "Paid";
      if($payment->method=="cheque"){
        $cheque = "Pending";
      }

      $payments_set[]=[
        'reference_id'=>$sale->id,
        'contact_id'=>$contact_id,
        'payment_type'=>$payment->method,
        'amount'=>$payment->amount,
        'store_id'=>$store_id,
        'cheque_status'=>$cheque,
      ];

      //Only credit amount decreased in customer
      if($payment->method=='credit') 
      {
        Contact::find($contact_id)->decrement('balance',$payment->amount);
      }
      else{
        $paid_amount = $paid_amount+$payment->amount;
      }
    }

    $sale->profit = $profit;
    $sale->paid = $paid_amount;
    $sale->save();

    SaleItem::insert($sale_items);
    Payment::insert($payments_set);

    return response()->json(["type"=>"success","message"=>"Record Added","reciept"=>$sale->id]);
  }

  public function updateSale(Request $request){
    $cart = json_decode($request->input('cart'));
    $store_id = $request->session()->get('store_id');
    $profit = 0;
    $total = 0;

    $sale = Sale::find($request->sale_id);
    $sale->store_id = $store_id;

    $sale_items = [];
    foreach($cart as $key=>$item){
      $sale_items[] = [
        'sale_id'=>$sale->id,
        'product_id'=>$item->id,
        'cost'=>$item->cost,
        'price'=>$item->price,
        'discount'=>$item->discount,
        'quantity'=>$item->quantity,
        'note'=>$item->note
      ];
      $profit +=($item->price-$item->cost)*$item->quantity;
      $total += $item->price*$item->quantity;
      StoreProduct::where('product_id',$item->id)
                    ->where('store_id',$store_id)
                    ->decrement('quantity',$item->quantity);
      Product::find($item->id)->decrement('quantity',$item->quantity);
    }
    $sale->total +=$total;

      //If the payment method is cheque then cheque status should be pending
      $payments_set[]=[
        'reference_id'=>$sale->id,
        'contact_id'=>$sale->contact_id,
        'payment_type'=>'credit',
        'amount'=>$total,
        'store_id'=>$store_id,
        'cheque_status'=>"Paid",
      ];
    Contact::find($sale->contact_id)->decrement('balance',$total);

    $sale->profit += $profit;
    $sale->save();

    SaleItem::insert($sale_items);
    Payment::insert($payments_set);

    return response()->json(["type"=>"success","message"=>"Record Added","reciept"=>$sale->id]);
  }

  public function holdSale(Request $request){

    $cart = json_decode($request->input('cart'));
    $contact_id = $request->input('contact');
    $store_id = $request->session()->get('store_id');

    $hold = new SaleHold;
    $hold->contact_id = $contact_id;
    $hold->total = $request->input('total');
    $hold->note = $request->input('note');
    
    $hold->store_id = $store_id;
    $hold->save();

    $sale_items = [];
    foreach($cart as $key=>$item){
      $sale_items[] = [
        'hold_id'=>$hold->id,
        'sale_id'=>0,
        'product_id'=>$item->id,
        'cost'=>$item->cost,
        'price'=>$item->price,
        'discount'=>$item->discount,
        'quantity'=>$item->quantity,
        'note'=>$item->note
      ];
    }
    SaleItem::insert($sale_items);

    return response()->json(["type"=>"success","message"=>"Hold Successfully Saved"]);
  }

  public function getHoldList(){
    $hold = SaleHold::select('sale_holds.*','contacts.name')
                      ->leftJoin("contacts","contacts.id","=","sale_holds.contact_id")->get();
    return response()->json(["holdlist"=>$hold]);
  }
  public function getHoldItems(Request $request){
    $hold = SaleItem::select('sale_items.*','products.name', 'products.image', 'products.id')
                      ->leftJoin("products","products.id","=","sale_items.product_id")
                      ->where('hold_id','=',$request->id)
                      ->get();
    $hold->makeHidden(['sale_items.id','product_id']);
    SaleItem::where('hold_id',$request->id)->forceDelete();
    SaleHold::where('id',$request->id)->delete();
    return response()->json(["holditems"=>$hold]);
  }
}
