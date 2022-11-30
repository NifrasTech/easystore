<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseItem extends Model
{
    use HasFactory,SoftDeletes;

    public function scopeJoined($query){
        return $query->select("purchase_items.*",'products.name')
                     ->leftJoin("purchases","purchases.id","=","purchase_items.purchase_id")
                     ->leftJoin("products","products.id","=","purchase_items.product_id");
    }
}
