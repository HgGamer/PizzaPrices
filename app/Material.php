<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "pizza_materials";

    public function materialsCategory(){
        return $this->belongsTo('App\MaterialsCategory', 'materials_id', 'id');
    }
}
