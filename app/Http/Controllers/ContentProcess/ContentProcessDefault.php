<?php

namespace App\Http\Controllers\ContentProcess;

class ContentProcessDefault extends ContentProcessBase
{
    public function __construct()
    {

    }
    public function sliceContent($content){

        $content = parent::sliceContent($content);
        $content = explode(",", $content);

        $content = array_map('trim', $content);

        return $content;
    }

}
