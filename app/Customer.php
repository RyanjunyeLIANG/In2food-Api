<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = 'customerName';

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function contacts() {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
