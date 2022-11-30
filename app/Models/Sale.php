<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'sales';

    public function scopeJoined($query){
        return $query->select('sales.*','contacts.name as contact')
                     ->leftJoin("contacts","contacts.id","=","sales.contact_id");
    }
}
