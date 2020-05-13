<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['firstName', 'lastName', 'phone', 'email'];

    public function contactable() {
        return $this->morphTo();
    }
}
