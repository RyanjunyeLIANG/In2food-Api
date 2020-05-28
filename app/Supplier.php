<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = ['supplierName'];

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function contacts() {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function items() {
        return $this->hasMany(Item::class);
    }
}
