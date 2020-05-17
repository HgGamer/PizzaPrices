<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use App\Log;
use App\Material;

class GenerationController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }

    private function generateImage($materialIds){
        shell_exec('cd ../js/pizzagenerator && node pizzagenerator.js "' .escapeshellarg($materialIds) . '"');
    }

    public function generateImages(){
        $materialIds = [];

        //gether all material ids with images
        //gether all pizzas
        //check if we have every image for pizza
        //order ids by category
        //generate image
        $this->generateImage('[1,2,3]');

    }


}
