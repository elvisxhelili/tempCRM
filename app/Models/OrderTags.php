<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTags extends Model
{

    public function tags()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id');
    }

}
