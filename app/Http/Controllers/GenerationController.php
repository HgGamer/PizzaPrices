<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use App\Log;
use App\Material;
use App\PizzaAlias;
use App\Traits\PizzaQueryTrait;
use App\Jobs\generatePizzaImages;

class GenerationController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }
    public function generateImagesFast($fast=true){
        $this->generateImages(true);
    }

    public function generateImages($fast=false){
        if(\Queue::size('generatePizzaImages')>1){
            return;
        };
        //gether all material ids with images
        $materialIds = Material::all()->whereNotNull('gen_img')->pluck('id')->toArray();
        //gether all pizzas

	    $generated = 0;
        $pizzaAliases = PizzaAlias::all();
        foreach ($pizzaAliases as $pizzaAlias) {


            $receptekString = explode(",",substr(substr_replace($pizzaAlias->recept, '', 0, 1), 0, -1)); // első utolsó karakter levágása
            //check if we have every image for pizza

            if(count($receptekString) != 0 && count(array_intersect($receptekString, $materialIds)) == count($receptekString)){
                //order ids by category

                if($fast && file_exists('img/generated_feltetek/' .$pizzaAlias->recept .'.png')){
                    continue;
                }

                $generated++;
                $materialObjects = [];
                foreach ($receptekString as $receptString) {

                    $material= Material::find($receptString);

                    if($material != null){
                        $materialObjects[] =  $material;
                    }
                }

                //generate image

                generatePizzaImages::dispatch(json_encode($this->orderMaterialObjects($materialObjects)))->onQueue('generatePizzaImages');
            }

        }
	    echo $generated;
    }
    private function orderMaterialObjects($materialObjects){
        $c = collect($materialObjects);
        foreach ($c as $materialObject) {
            if ($materialObject->category_id == 2) {
                $materialObject->category_id = 1000;
            }
        }
        $materialObjects = $c->sortBy('category_id')->values();

        $finalMaterialsArray = [];
        foreach ($materialObjects as $material) {
            if  (!isset($material->name)){
                continue;
            }
            if(!in_array($material->id, $finalMaterialsArray)){
                $finalMaterialsArray[] = $material->id;
            }

        }

         //Csak a neveket adja vissza tömbként
        return $finalMaterialsArray;
    }


}
