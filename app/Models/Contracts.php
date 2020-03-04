<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    public function customer() {

    	return $this->belongsTo(Customer::class);
    }
}
