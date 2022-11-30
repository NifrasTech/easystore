<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Store;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function gotoProduct(){
        $pageConfigs = ['pageHeader' => false];
        $brands = Brand::all();
        $categories = Category::all();

        //Implement this coding (check if auth user is admin or not)
        $stores = Store::all();

        return view('/products/products', ['pageConfigs' => $pageConfigs,'brands'=>$brands,'categories'=>$categories,'stores'=>$stores]);
    }

    public function showProducts(Request $request){

        if($request->store_id == 'all') {
            $products = Product::query();
            $products = $products->joined()->selectRaw('cost*quantity as valuation');
        }
        else {
            $products = StoreProduct::query();
            $products = $products->ProductsJoined()->where('store_id',$request->store_id)->selectRaw('cost*store_products.quantity as valuation');
        }

        if($request->brand_id != 'all') $products->where('products.brand_id',$request->brand_id);

        if($request->is_alert=='true'){
            $products = $products->whereRaw('alert_quantity > quantity');
        }

        return datatables()->of($products)->make(true);
    }

    //Find Product By ID
    public function findProduct(Request $request){
        $product=Product::findOrFail($request->input('product'));
        return response()->json($product);
    }

    public function imageProduct(Request $request){
        $product = Product::find($request->id);
        if(!empty($request->image))
        {
            $fileName = date("YmdhisU").'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $fileName);
            $fileName = "images/products/".$fileName;

            if(File::exists(public_path($product['image']))){
                if(!empty($product['image'])){
                    unlink(public_path($product['image']));
                }
            }

            $product['image']=$fileName;
        }
        $product->save();
        $data = array("message"=>"Image uploaded successfully", "product"=>$request->all());
        return response()->json($data);
    }
}
