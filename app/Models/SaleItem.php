<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sale_items';

    public function scopeJoined($query){
        return $query->select("sale_items.*",'products.name')
                     ->leftJoin("sales","sales.id","=","sale_items.sale_id")
                     ->leftJoin("products","products.id","=","sale_items.product_id");
    }
}
