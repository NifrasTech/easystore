<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';

    public function scopeJoined($query)
	{
		return $query->select('products.*','brands.name as brand_name','categories.name as category_name')
					 ->leftJoin("brands","products.brand_id","=","brands.id")
					 ->leftJoin("categories","products.category_id","=","categories.id");
	}
}
