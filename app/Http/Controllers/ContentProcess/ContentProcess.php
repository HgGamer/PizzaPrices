<?php

namespace App\Http\Controllers\ContentProcess;

class ContentProcess
{
    public function __construct()
    {

    }
    public function sliceContent($id,$content){
        $processor = null;
        switch ($id) {
            case 'value':
                # code...
                break;
            default:
                $processor = new ContentProcessDefault();
                break;
        }
        return $processor->sliceContent($content);
    }

}
