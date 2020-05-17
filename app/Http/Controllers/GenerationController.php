<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use App\Log;
use App\Material;
use App\PizzaAlias;
use App\Traits\PizzaQueryTrait;

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
                foreach ($receptekString as $receptString) {
                    $material= Material::find($receptString);
                    if($material != null){
                        $materialObjects[] =  $material;
                    }
                }
                //generate image
		$generated++;
                $this->generateImage(json_encode($this->orderMaterialObjects($materialObjects)));
            }
        }
	echo $generated;
    }
    private function orderMaterialObjects($materialObjects){
        $c = collect($materialObjects);

        $materialObjects = $c->sortBy('category_id')->values();

        $finalMaterialsArray = [];
        foreach ($materialObjects as $material) {
            if  (!isset($material->name)){
                continue;
            }
            $finalMaterialsArray[] = $material->id;
        }
         //Csak a neveket adja vissza tömbként
        return $finalMaterialsArray;
    }


}
