<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataProtectionLink extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function website()
    {
        return $this->belongsTo('App\Website', 'website_id');
    }

    public function itemSchema()
    {
        return $this->belongsTo('App\ItemSchema', 'item_schema_id');
    }
}
