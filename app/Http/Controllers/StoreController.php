<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class StoreController extends Controller
{
    public function gotoStores(){
        $pageConfigs = ['pageHeader' => false];
        $user = Auth::user();
        return view('/stores/stores', ['pageConfigs' => $pageConfigs,'user'=>$user]);
    }

    public function showStores(Request $request)
    {
        return datatables()->of(Store::all())->make(true);
    }

    public function deleteStore(Request $request){
        if($request->id==1) return response()->json(["type"=>"error","message"=>"The Main Store Cannot be deleted"]);
        // Store::find($request->id)->delete();
        return response()->json(["type"=>"success","message"=>"Store delete option is on the way..."]);
    }

    public function selectStore($id){
        $store = Store::find($id);
        session(["store_name"=>$store->name]);
        session(["store_id"=>$store->id]);
        return redirect()->route('stores');
    }
}
