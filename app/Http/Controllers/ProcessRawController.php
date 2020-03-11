<?php

namespace App\Http\Controllers;

use App\MaterialAlias;
use App\Material;
use App\PizzaType;
use App\RawPizza;
use Illuminate\Http\Request;

class ProcessRawController extends Controller
{

    protected $returnData = [];
    public function __construct()
    {

        $this->middleware('auth');
    }

    private function sliceContent($content){
        return array_map('trim',preg_split("/[,]+/", $content));
    }

    private function processContent($sitedata){
        foreach($sitedata as $datarow){
            $content = ($this->sliceContent($datarow['content']));
            $recept = $this->processContentRow($content);
            //dd($recept);
            if($recept != null){
                //nem történt hiba, megvan a recept aliasok alapján és most megkeressük a pizzát a receptek táblában

                //nem találtunk olyan receptet ami telesen megegyezik ezzel,
                    //hiba, új pizzát találtunk, felvegyük ezt a listába?
                // megtaláltuk, összehasonlítjuk a neveket
                    // nem ismert név, felvesszük ezt aliasnak
                //ismert név, minden rendben
            }else{
                return;
            }
        }

    }

    private function processMaterial($material){
        if(MaterialAlias::all()->where("name",$material)->count()== 0){
            $dat = (array("message" => "unknown material","data" => $material));
            array_push($this->returnData,$dat);
            // nem ismerjük a materialt
           return -1;
        }else{
            //ismerjük a materialtasdas sadasd
            return (MaterialAlias::all()->where("name",$material)->first()->material_id);
        }

    }
    /**
     * @param $content content
     * @return array $recept
     */
    private function processContentRow($content){
        $recept = [];
        $failed = false;
        foreach($content as $material){
            array_push($recept,$material);
            $processedMaterial = $this->processMaterial($material);
            if($processedMaterial==-1){
                $failed = true;
                return false;
            }else{
                array_push($recept,$processedMaterial);
            }
        }
        if($failed){
            return null;
        }
        return $recept;
    }


    public function processRaw(){
        $id = 3;
        $sitedata = RawPizza::all()->where('website_id',$id);
        $this->processContent($sitedata);
        return $this->returnData;

    }

    public function processPost(Request $request){


    }
    public function getmaterials(Request $request){
        return Material::all();
    }

    public function newMaterial(Request $request){
        $errordata = $request->errordata;
        $material = new Material();
        $material->name = $errordata;
        $material->save();
        $alias = new MaterialAlias();
        $alias->material_id = $material->id;
        $alias->name = $errordata;
        $alias->save();
        return redirect('/dashboard/process');
    }

    public function newMaterialAlias(Request $request){
        $newalias = $request->newalias; // select
        $errordata = $request->errordata;
        $alias = new MaterialAlias();
        $alias->material_id = $newalias;
        $alias->name = $errordata;
        $alias->save();

        return redirect('/dashboard/process');
    }
}
