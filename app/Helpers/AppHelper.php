<?php
namespace App\Helpers;


class AppHelper
{

    public function addLog($data){
        $log = new \App\Log();
        $log->text = $data;
        $log->save();

    }

    public static function shared()
    {
        return new AppHelper();
    }

}
