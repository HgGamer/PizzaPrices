<?php
namespace App\Helper;
use Illuminate\Support\Facades\Log;

class LogManager{

    private static $shared;

    protected function __construct(){
        //kell h ne lehessen újat létrehozni
    }

    public static function shared()
    {
        if (null === static::$shared) {
            static::$shared = new LogManager();
        }

        return static::$shared;
    }

    public function addLog($data){
        Log::debug($data);
        $log = new \App\Log();
        $log->text = $data;
        $log->save();

    }



}
