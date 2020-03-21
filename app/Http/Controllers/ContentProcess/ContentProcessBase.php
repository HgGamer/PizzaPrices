<?php

namespace App\Http\Controllers\ContentProcess;

class ContentProcessBase
{
    public function __construct()
    {

    }
    public function sliceContent($content){

        $content = str_replace('(','',$content);
        $content = str_replace(')','',$content);

        return $content;

    }

}
