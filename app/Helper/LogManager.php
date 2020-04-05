<?php
namespace App\Helper;


class LogManager{

    protected function __construct(){
        //kell h ne lehessen újat létrehozni
    }

    public static function shared()
    {
        static $shared = null;
        if (null === $shared) {
            $shared = new LogManager();
        }

        return $shared;
    }

    public function addLog($data){
        $log = new \App\Log();
        $log->text = $data;
        $log->save();

    }



}
