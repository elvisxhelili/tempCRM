<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function orderTags()
    {
        return $this->belongsToMany(OrderTags::class);
    }
}
