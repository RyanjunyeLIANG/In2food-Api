<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = ['itemName', 'category', 'description', 'unitPrice'];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
