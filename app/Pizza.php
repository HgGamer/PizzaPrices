<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $table = "pizza";
 
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
 
    public function website()
    {
        return $this->belongsTo('App\Website', 'website_id');
    }
}
