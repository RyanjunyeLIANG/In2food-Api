<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = ['street', 'suburb', 'state', 'postcode'];

    public function addressable() {
        return $this->morphTo();
    }
}
