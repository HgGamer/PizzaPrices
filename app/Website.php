<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{

    protected $table = "website";

    public function storeDatas(){
        return $this->hasMany('App\StoreData', 'websiteid');
    }

}
