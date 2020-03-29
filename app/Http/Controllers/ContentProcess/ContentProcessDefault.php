<?php

namespace App\Http\Controllers\ContentProcess;

class ContentProcessDefault extends ContentProcessBase
{
    public function __construct()
    {

    }
    public function removeUnwanted($word){
        $esapables  = ["</span>"];
        foreach ($esapables as $escape) {
            $word = str_replace($escape,"",$word);
        }
        return $word;
    }
    public function sliceContent($content){
        $content = strip_tags($content);
        $content = parent::sliceContent($content);


        $content = explode(",", $content);

        $content = array_map('trim', $content);
        $content = array_map('mb_strtolower', $content);

        $content = array_map(array($this, 'removeUnwanted'),$content);

        for($i = 0;$i<count($content);$i++){
            if (strpos($content[$i], 'tészta') !== false) {
                unset($content[$i]);
                break;
            }
            if (strpos($content[$i], 'teszta') !== false) {
                unset($content[$i]);
                break;
            }
            if ($content[$i] == '') {
                unset($content[$i]);
                break;
            }
        }

        return $content;
    }

}
