<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\ContentProcess\ContentProcessDefault;

class ContentProcessTest extends TestCase
{
    public function testHTML(){
        $content = "<b>oregánó</b>";
        $processor = new ContentProcessDefault();
        $processor->sliceContent($content);
        $this->assertEquals($processor->sliceContent($content), ['oregán ó']);
    }

}
