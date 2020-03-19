<?php

namespace App\Http\Controllers;

use App\ItemSchema;
use App\MaterialAlias;
use App\Material;
use App\Pizza;
use App\PizzaAlias;
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

        if( $this->regexp == null){
            return null;
        }
        return array_map('trim',preg_split( $this->regexp, $content));
    }

    private function processContent($sitedata){

        foreach($sitedata as $datarow){
            $content = ($this->sliceContent($datarow['content']));
            $recept = $this->processContentRow($content);
        }


        foreach($sitedata as $datarow){
            $content = ($this->sliceContent($datarow['content']));
            $recept = $this->processContentRow($content);
            $processedPizza = $this->processPizza($datarow['title'],$recept);
            if($processedPizza==-1){
                $failed = true;
                return false;
            }
        }



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
    private function receptToString($recept){
        sort($recept);
        return (json_encode($recept));
    }

    private function receptToReadableString($recept){
        $ret = [];
        sort($recept);
        foreach ($recept as $mat) {
            array_push($ret, Material::all()->where('id',$mat)->first()->name);
        }
        return $ret;
    }


    private function processPizza($pizza,$recept){

        //ismert a név? ha nem:
        if(PizzaAlias::all()->where('name',$pizza)->count()!=0){
            return;
        }
        //csekkolni hogy léteik e a recept más néven.
        if(Pizza::all()->where('recept',$this->receptToString($recept))->count()!=0){
            //kell a pizza idje az aliashoz
            $id = Pizza::all()->where('recept',$this->receptToString($recept))->first()->id;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->save();
            return;
        }
        //benne van e #skipp#
        if(in_array(1, $recept)){
            return;
        }
        //ha nem szólunk a felhasználónak:
        $dat = (array(
                    "message" => "unknown pizza",
                    "data" => $pizza,
                    "recept"=>$this->receptToString($recept),
                    "receptreadable"=>$this->receptToReadableString($recept)
                ));
        array_push($this->returnData,$dat);
        return -1;

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
        $this->regexp = ItemSchema::all()->where('id',$id)->first()->regexp;

        $this->processContent($sitedata);
        return $this->returnData;

    }

    public function processPost(Request $request){


    }
    public function getmaterials(Request $request){
        return Material::orderBy('name', 'ASC')->get();
    }

    public function getpizzas(Request $request){
        return Pizza::orderBy('name', 'ASC')->get();
    }

    public function getPizza(Request $request){
        return Pizza::orderBy('name','ASC')->get();
    }




    public function newMaterial(Request $request){
        $errordata = $request->errordata;
        $req = Material::all()->where('name',$errordata)->first();
        if($req != null){
            return "nono";
        };
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
    public function newPizza(Request $request){

        $errordata = $request->errordata;
        $req = Pizza::all()->where('name',$errordata)->first();
        if($req != null){
            return "nono";
        };
        $pizza = new Pizza();
        $pizza->name = $errordata;
        $pizza->recept = $request->recept;
        $pizza->save();

        $alias = new PizzaAlias();
        $alias->pizzaid = $pizza->id;
        $alias->name = $errordata;
        $alias->save();

        return redirect('/dashboard/process');
    }
}
