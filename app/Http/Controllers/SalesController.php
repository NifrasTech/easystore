<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Setting;
use App\Models\Store;

class SalesController extends Controller
{
    //
    function showReciept($id){
        $sale = Sale::joined()->where("sales.id",$id)->first();
        $soldItems = SaleItem::select('products.name','sale_items.*')->leftJoin('products','products.id','=','sale_items.product_id')->where('sale_id',$id)->get();
        $setting = Setting::first();
        $branch = Store::find($sale->store_id);
        return view('POS.reciept',compact('sale','soldItems','setting','branch'));    
    }

    public function gotoSaleItems(){
        $pageConfigs = ['pageHeader' => false];
        return view('sales.saleitems',['pageConfigs' => $pageConfigs]);
    }

    function gotoSales(){
        $pageConfigs = ['pageHeader' => false];
        return view('sales.sales',['pageConfigs' => $pageConfigs]);
    }

    function showSales(Request $request){
        $sales = Sale::query();
        if(isset($request->from) && isset($request->to))
        {
            $sales = $sales->whereBetween('sales.created_at',[$request->from, $request->to]);
        }
        
        $sales = $sales->joined();
        return datatables()->eloquent($sales)
                           ->editColumn('created_at', function($sales){return $sales->created_at->format("Y-m-d");})
                           ->make(true);
    }

    function showSaleItems(Request $request){
        $saleItems = SaleItem::query();
        if(isset($request->from) && isset($request->to))
        {
            $saleItems = $saleItems->whereBetween('sale_items.created_at',[$request->from, $request->to]);
        }
        $saleItems = $saleItems->whereNull('hold_id')->joined();
        return datatables()->eloquent($saleItems)
                           ->editColumn('created_at', function($saleItems){return $saleItems->created_at->format("Y-m-d");})
                           ->addColumn('total',function($saleItems){
                            return ($saleItems->price-$saleItems->discount)*$saleItems->quantity;
                           })
                           ->rawColumns(['total'])
                           ->make(true);
    }

    function updateSaleStatus(Request $request){
        $sale = Sale::find($request->id);

        if($sale->status == 'Open') $sale->status = "Closed";
        else $sale->status = "Open";
        $sale->save();

        return response()->json(["type"=>"success","message"=>"Status Updated"]);
    }
}
