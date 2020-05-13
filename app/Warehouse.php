<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{   
    protected $table = 'warehouses';
    
    protected $fillable = ['warehouseName', 'phone'];

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }
}
