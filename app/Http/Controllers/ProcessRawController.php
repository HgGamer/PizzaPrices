<?php

namespace App\Http\Controllers;

use App\ItemSchema;
use App\MaterialAlias;
use App\Material;
use App\Pizza;
use App\PizzaAlias;
use App\PizzaType;
use App\RawPizza;
use App\Log;
use App\StoreData;
use App\Http\Controllers\ContentProcess\ContentProcess;
use Illuminate\Http\Request;
use Exception;
class ProcessRawController extends Controller
{

    protected $returnData = [];
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function sliceContent($id,$content){


        $proc = new ContentProcess();
        //dd($proc->sliceContent($id, $content));


        return $proc->sliceContent($id, $content);
    }

    private function processContent($sitedata,$websiteid){
        //az össes pizza materialjait nézi ismeri e
        foreach($sitedata as $datarow){
            if($datarow['content'] == ""){
                RawPizza::all()->where('id',$datarow['id'])->first()->delete();
                $this->log("Recept törlése, content üres");
            }
            $content = ($this->sliceContent($websiteid,$datarow['content']));
            $recept = $this->processContentRow($content);
        }

        //végig megyünk a pizzákon is
        foreach($sitedata as $datarow){
            $content = ($this->sliceContent($websiteid,$datarow['content']));

            $recept = $this->processContentRow($content);
            $processedPizza = $this->processPizza($datarow['title'],$recept);
            if($processedPizza==-1){
                $failed = true;
                return false;
            }
        }

        //ezen a ponton a pizzák receptjeit és a pizzákat is ismerjük, feltöltjük a store databest a weboldal idjével és pizza árakkal
        foreach($sitedata as $datarow){
            $this->storePizzaForSite($datarow,$websiteid);
        }

    }

    private function storePizzaForSite($data,$websiteid){
        try{
            $storedata = new StoreData();
            $storedata->websiteid = $websiteid;
            $alias = PizzaAlias::all()->where('name',$data->title)->first();
            $pizzaid =$alias->id;
            //benne van e a dbben ez a pizza?
            if(StoreData::all()->where('websiteid',$websiteid)->where('pizzaid',$pizzaid)->where('pizzasize',$data->size)->count()!=0){
                //már a dbben van a pizza
                return;
            }

            $storedata->pizzaid = Pizza::all()->where('id',$pizzaid)->first()->id;
            $storedata->price = $data->price;
            $storedata->pizzasize = $data->size;
            $this->log("Új pizza storehoz adva: ".$alias->name);
            $storedata->save();
        }catch (Exception $e) {
            report($e);
            return;
        }
    }

    private function receptToString($recept){
        if(!is_array($recept)){
            $this->log("Recept is not an array");
            return;
        }
        sort($recept);
        return (json_encode($recept));
    }

    private function receptToReadableString($recept){
        if(!is_array($recept)){
            $this->log("Recept is not an array");
            return;
        }
        $ret = [];
        sort($recept);
        foreach ($recept as $mat) {
            array_push($ret, Material::all()->where('id',$mat)->first()->name);
        }
        return $ret;
    }

    private function escapePizzaName($pizzaname){
        $pizzaname = mb_strtolower($pizzaname);
        $esapables  = ["32cm", "32 cm", "26 cm" , "pizza", "()",];
        foreach ($esapables as $escape) {
            $pizzaname = str_replace($escape,"",$pizzaname);
        }
        $pizzaname =  preg_replace('/(\d*\.)/', "", $pizzaname);
        $pizzaname = trim($pizzaname);
        return $pizzaname;
    }

    private function processPizza($pizza,$recept){

        $pizza = $this->escapePizzaName($pizza);
        //ismert a név hoppá ismerjük
        if(PizzaAlias::all()->where('name',$pizza)->count()!=0){
            if(PizzaAlias::all()->where('name',$pizza)->first()->recept == $this->receptToString($recept)){
                return;
            }
            if(PizzaAlias::all()->where('recept',$this->receptToString($recept))->count()!=0){
                //ezt ismerjük valamelyik alias receptje alapján
                $originalaias = PizzaAlias::all()->where('recept',$this->receptToString($recept))->first();
                $pizzaalias = new PizzaAlias();
                $pizzaalias->name = $pizza;
                $pizzaalias->pizzaid = $originalaias->pizzaid;
                $pizzaalias->recept = $this->receptToString($recept);
                $pizzaalias->save();
                $this->log("Új pizza alias : ". $pizzaalias->name);
                return;
            }
            $id = PizzaAlias::all()->where('name',$pizza)->first()->pizzaid;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->recept = $this->receptToString($recept);
            $pizzaalias->save();
            $this->log("Új pizza alias (új recepttel) : ". $pizzaalias->name);
            return;
        }
        //csekkolni hogy léteik e a recept más néven.
        if(Pizza::all()->where('recept',$this->receptToString($recept))->count()!=0){
            $this->log("Ezt a pizzát már recept alapján ismerjük, ".$pizza);
            //kell a pizza idje az aliashoz

            $id = Pizza::all()->where('recept',$this->receptToString($recept))->first()->id;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->recept = $this->receptToString($recept);
            $pizzaalias->save();
            return;
        }
        //benne van e #skipp#
        if(is_array($recept)){
            if(in_array(1, $recept)){
                return;
            }
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
            //ismerjük a materialt
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
        dd($content);
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
        //9 retard
        $id = 8;
        $sitedata = RawPizza::all()->where('website_id',$id);
        $this->regexp = ItemSchema::all()->where('id',$id)->first()->regexp;

        $this->processContent($sitedata,$id);
        return $this->returnData;

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
        $this->log("Új material hozzáadva: ". $material->name);
        return redirect('/dashboard/process');
    }

    public function newMaterialAlias(Request $request){
        $newalias = $request->newalias; // select
        $errordata = $request->errordata;
        $alias = new MaterialAlias();
        $alias->material_id = $newalias;
        $alias->name = $errordata;
        $alias->save();
        $this->log("Új material alias: ". $alias->name);
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
        $alias->recept = $request->recept;
        $alias->save();
        $this->log("Új pizza: ". $alias->name);
        return redirect('/dashboard/process');
    }

    public function newPizzaAlias(Request $request){
        $pizzaalias = new PizzaAlias();
        $pizzaalias->recept= $request->recept;
        $pizzaalias->name = $request->errordata;
        $pizzaalias->pizzaid = $request->newalias;
        $pizzaalias->save();
        $this->log("Új pizza alias: ". $pizzaalias->name);
        return redirect('/dashboard/process');
    }

    private function log($data){
        $l = new Log();
        $l->text = $data;
        $l->save();
    }

    public function refreshPizzaAliasRecept(){
       $data = PizzaAlias::all()->where('recept',null);
       foreach ($data as $dat) {
         $dat->recept = Pizza::all()->where('id',$dat->pizzaid)->first()->recept;
         $dat->save();
       }
    }

}
