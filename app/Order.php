<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['type', 'status', 'trackingNumber', 'orderDate', 'totalPrice'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function items() {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }
}
