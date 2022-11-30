<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    protected $fillable = ['store_id','product_id','quantity'];

    public function scopeJoined($query){
        return $query->select('store_products.*','stores.name')
                     ->leftJoin('stores','store_products.store_id','=','stores.id');
    }

    public function scopeProductsJoined($query){
        return $query->select('products.name','products.id','cost','price','barcode','brands.name as brand_name','store_products.quantity')
                    ->leftJoin('products','store_products.product_id','=','products.id')
                    ->leftJoin("brands","products.brand_id","=","brands.id");
    }
}
