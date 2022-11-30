<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function gotoNewPurchase(){
        // $pageConfigs = ['pageHeader' => false];

        // //Implement this coding (check if auth user is admin or not)
        // $stores = Store::all();
        // return view('/purchases/purchase', ['pageConfigs' => $pageConfigs, 'stores'=>$stores]);
        $pageConfigs = ['blankPage' => true];
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Blank"]];
        $pageConfigs = ['blankPage' => true,'contentLayout' => "content-left-sidebar",
        'pageClass' => 'file-manager-application','showMenu' => false,];
        $stores = Store::all();
        return view('/POS/pos', compact('pageConfigs','breadcrumbs','stores'));
    }

    public function gotoPurchases(){
        $pageConfigs = ['pageHeader' => false];
        return view('purchases.purchases',['pageConfigs' => $pageConfigs]);
    }

    public function showPurchases(Request $request){
        $purchases = Purchase::query();
        if(isset($request->from) && isset($request->to))
        {
            $purchases = $purchases->whereBetween('purchases.created_at',[[$request->from.' 00:00:00', $request->to.' 23:59:59']]);
        }
        $purchases = $purchases->joined();
        return datatables()->eloquent($purchases)
                           ->editColumn('purchase_date', function($purchases){return $purchases->purchase_date->format("Y-m-d");})
                           ->make(true);
    }

    public function storePurchase(Request $request){
        if(empty($request->discount)) $request->discount = 0;
        $data = $request->all();
        $data['created_by'] = Auth::id();
        $cart = json_decode($request->input('cart'));
        $purchase=Purchase::create($data);

        $purchase_items = [];
        foreach($cart as $key=>$item){
            $purchase_items[] = [
              'purchase_id'=>$purchase->id,
              'product_id'=>$item->id,
              'cost'=>$item->price,
              'price'=>$item->price,
              'discount'=>$item->discount,
              'quantity'=>$item->quantity,
              'note'=>$item->note
            ];
            StoreProduct::updateOrCreate(['store_id'=>$data["store_id"],'product_id'=>$item->id])->increment('quantity',$item->quantity);
            Product::find($item->id)->increment('quantity',$item->quantity);
          }

        PurchaseItem::insert($purchase_items);
        Contact::find($data['contact_id'])->decrement('balance',$data['total']);
        return response()->json(["type"=>"success","message"=>"Purchase Completed"]);
    }

    function updatePurchaseStatus(Request $request){
        $purchase = Purchase::find($request->id);

        if($purchase->status == 'Open') $purchase->status = "Closed";
        else $purchase->status = "Open";
        $purchase->save();

        return response()->json(["type"=>"success","message"=>"Status Updated"]);
    }

    function gotoEditPurchase(){
        $pageConfigs = ['blankPage' => true];

        return view('/content/miscellaneous/page-coming-soon', ['pageConfigs' => $pageConfigs]);
    }
}
