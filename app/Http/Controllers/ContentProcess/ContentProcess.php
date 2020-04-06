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
            case '5':
                preg_match('/^\/(([^\/])*)\//', $content, $content);
                $content = $content[1];
                $processor = new ContentProcessDefault();
                break;
            case '8': //american chicken
                $content = str_replace("<br>",",",$content);
                $processor = new ContentProcessDefault();
                break;
            case '23':
                $content = str_replace("<li>",",",$content);
                $processor = new ContentProcessDefault();
                break;
            default:

                $processor = new ContentProcessDefault();
                break;
        }
        return $processor->sliceContent($content);
    }

}
