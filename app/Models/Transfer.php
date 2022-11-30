<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['transfer_date'];
    protected $fillable = ['transfer_date', 'from_store','to_store','cost','status','note','reference','created_by'];

    public function scopeJoined($query){
        return $query->select('transfers.*','tbl_from.name as from_store','tbl_to.name as to_store')
                     ->leftJoin("stores AS tbl_from","tbl_from.id","=","transfers.from_store")
                     ->leftJoin("stores AS tbl_to","tbl_to.id","=","transfers.to_store");
    }
}
