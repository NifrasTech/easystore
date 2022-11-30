<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Models\Transfer;
use App\Models\TransferItems;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function gotoTransfers(){
        $pageConfigs = ['pageHeader' => false];
        return view('transfers.transfers',['pageConfigs' => $pageConfigs]);
    }

    public function gotoNewTransfer(){
        $pageConfigs = ['blankPage' => true];
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Blank"]];
        $pageConfigs = ['blankPage' => true,'contentLayout' => "content-left-sidebar",
        'pageClass' => 'file-manager-application','showMenu' => false,];
        $stores = Store::all();
        return view('/POS/pos', compact('pageConfigs','breadcrumbs','stores'));
    }

    public function showTransfers(){
        $transfers = Transfer::query();
        $transfers = $transfers->joined();
        return datatables()->eloquent($transfers)
                           ->editColumn('transfer_date', function($transfers){return $transfers->transfer_date->format("Y/m/d");})
                           ->make(true);
    }

    public function storeTransfer(Request $request){
        $data = $request->all();

        if(empty($data['from_store']) || empty($data['to_store']))
        {
            return response()->json(["type"=>"error","message"=>"Please Select Store"]); 
        }

        $data['created_by'] = Auth::id();
        $cart = json_decode($request->input('cart'));
        $transfer=Transfer::create($data);

        $transfer_items = [];
        foreach ($cart as $id => $product){
            $transfer_items[]=[
                "transfer_id"=>$transfer->id,
                'product_id'=>$product->id,
                'cost'=>$product->cost,
                'price'=>$product->price,
                'quantity'=>$product->quantity,
            ];
        }

        TransferItems::insert($transfer_items);
        return response()->json(["type"=>"success","message"=>"Transfer Record Added"]);
    }

    function updateTransferStatus(Request $request){
        $transfer = Transfer::find($request->id);
        $result = "";
        $transfer_items = TransferItems::where('transfer_id',$transfer->id)->get();
        if($transfer->status == 'Pending') {
            $transfer->status = "Transfered";
            foreach($transfer_items as $item){
                StoreProduct::where('product_id',$item->product_id)
                ->where('store_id',$transfer->from_store)->decrement('quantity',$item->quantity);
                StoreProduct::where('product_id',$item->product_id)
                ->where('store_id',$transfer->to_store)->increment('quantity',$item->quantity);
            }
        }
        else {
            $transfer->status = "Pending";
            foreach($transfer_items as $item){
                StoreProduct::where('product_id',$item->product_id)
                ->where('store_id',$transfer->from_store)->increment('quantity',$item->quantity);
                StoreProduct::where('product_id',$item->product_id)
                ->where('store_id',$transfer->to_store)->decrement('quantity',$item->quantity);
            }
        }
        $transfer->save();

        return response()->json(["type"=>"success","message"=>"Status Updated",'result'=>$transfer_items]);
    }

    function getTransferItems(Request $request){
        $transfer_items = TransferItems::select('transfer_items.*','products.name')
                      ->leftJoin("products","products.id","=","transfer_items.product_id")
                      ->where('transfer_id',$request->id)->get();
        return response()->json(["transferItems"=>$transfer_items]);
    }
}
