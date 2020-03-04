<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = ['title', 'description', 'cost', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Order::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contracts::class);
    }

    public function orderTags()
    {
        return $this->hasMany(OrderTags::class);
    }
}
