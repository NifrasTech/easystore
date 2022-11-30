<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['purchase_date'];
    protected $fillable = ["contact_id","reference","total","discount","note","store_id","purchase_date","created_by"];

    public function scopeJoined($query){
        return $query->select('purchases.*','contacts.name as contact')
                     ->leftJoin("contacts","contacts.id","=","purchases.contact_id");
    }
}
