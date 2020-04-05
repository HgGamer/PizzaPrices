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
use App\Helper\LogManager;

class ProcessRawController extends Controller
{

    protected $returnData = [];
    protected $websiteid = 0;
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function sliceContent($id,$content){
        $proc = new ContentProcess();
        return $proc->sliceContent($id, $content);
    }

    private function processContent($sitedata,$websiteid){
        //az össes pizza materialjait nézi ismeri e
        foreach($sitedata as $datarow){
            if($datarow['content'] == ""){
                RawPizza::all()->where('id',$datarow['id'])->first()->delete();
                LogManager::shared()->addLog("Recept törlése, content üres");
            }
            $content = ($this->sliceContent($websiteid,$datarow['content']));
            $recept = $this->processContentRow($content);
        }

        //végig megyünk a pizzákon is
        foreach($sitedata as $datarow){
            $content = ($this->sliceContent($websiteid,$datarow['content']));

            $recept = $this->processContentRow($content);
            $processedPizza = $this->processPizza($datarow,$recept);
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

    private function storePizzaForSite($data,$websiteid, $alias = null, $rawid = null){
        try{
            $storedata = new StoreData();
            $storedata->websiteid = $websiteid;
            if($alias == null){
                $alias = PizzaAlias::all()->where('name',$this->escapePizzaName($data->title))->first();
            }else{
                $data = RawPizza::all()->where('id',$rawid)->first();
            }

            $pizzaid =$alias->pizzaid;
            if($pizzaid == 1){
                return;
            }
            //benne van e a dbben ez a pizza?
            if(StoreData::all()->where('websiteid',$websiteid)->where('pizzaid',$pizzaid)->where('pizzasize',$data->size)->count()!=0){
                //már a dbben van a pizza
                dd('már benne van storedatába');
                RawPizza::all()->where('id',$data['id'])->first()->delete();
                return;
            }

            $storedata->pizzaid = Pizza::all()->where('id',$pizzaid)->first()->id;
            $storedata->price = $data->price;
            $storedata->pizzasize = $data->size;
            $storedata->url = RawPizza::all()->where('id',$data['id'])->first()->source_link;
            dd('már benne van storedatába');
            LogManager::shared()->addLog("Új pizza storehoz adva: ".$alias->name);

            $storedata->save();
            RawPizza::all()->where('id',$data['id'])->first()->delete();
        }catch (Exception $e) {
            LogManager::shared()->addLog($e);
            report($e);
            return;
        }
    }

    private function receptToString($recept){
        if(!is_array($recept)){
            LogManager::shared()->addLog("Recept is not an array");
            return;
        }
        sort($recept);
        return (json_encode($recept));
    }

    private function receptToReadableString($recept){
        if(!is_array($recept)){
            LogManager::shared()->addLog("Recept is not an array");
            return;
        }
        $ret = [];
        sort($recept);
        foreach ($recept as $mat) {
            $material = Material::all()->where('id',$mat)->first();
            if($material != null){
                array_push($ret, Material::all()->where('id',$mat)->first()->name);
            }else{
                LogManager::shared()->addLog("receptToReadableString, material null, ilyennek nem kéne előfordulnia");
            }

        }
        return $ret;
    }

    private function escapePizzaName($pizzaname){
        $pizzaname = mb_strtolower($pizzaname);
        $esapables  = ["32cm", "32 cm", "26 cm", "30 cm", "30cm" , "pizza", "()",];
        foreach ($esapables as $escape) {
            $pizzaname = str_replace($escape,"",$pizzaname);
        }
        $pizzaname =  preg_replace('/(\d*\.)/', "", $pizzaname);
        $pizzaname = trim($pizzaname);
        return $pizzaname;
    }

    private function processPizza($data,$recept){
        $pizza = $this->escapePizzaName($data['title']);
        //ismert a név hoppá ismerjük
        if(PizzaAlias::all()->where('name',$pizza)->count()!=0){
            if(PizzaAlias::all()->where('name',$pizza)->first()->recept == $this->receptToString($recept)){
                return;
            }
            if(PizzaAlias::all()->where('recept',$this->receptToString($recept))->count()!=0){
                //ezt ismerjük valamelyik alias receptje alapján
                $originalaias = PizzaAlias::all()->where('recept',$this->receptToString($recept))->first();
                if($originalaias->name == $pizza){
                    if( $originalaias->pizzaid == 1){
                        dd('skippen van');
                    }
                    return;
                }
                $pizzaalias = new PizzaAlias();
                $pizzaalias->name = $pizza;
                $pizzaalias->pizzaid = $originalaias->pizzaid;
                $pizzaalias->recept = $this->receptToString($recept);
                $pizzaalias->save();
                $this->storePizzaForSite($data,$this->websiteid);
                LogManager::shared()->addLog("Új pizza alias : ". $pizzaalias->name);
                return;
            }
            $id = PizzaAlias::all()->where('name',$pizza)->first()->pizzaid;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->recept = $this->receptToString($recept);
            $pizzaalias->save();
            $this->storePizzaForSite($data,$this->websiteid);
            LogManager::shared()->addLog("Új pizza alias (új recepttel) : ". $pizzaalias->name);
            return;
        }
        //csekkolni hogy léteik e a recept más néven.
        if(Pizza::all()->where('recept',$this->receptToString($recept))->count()!=0){
            LogManager::shared()->addLog("Ezt a pizzát már recept alapján ismerjük, ".$pizza);
            //kell a pizza idje az aliashoz

            $id = Pizza::all()->where('recept',$this->receptToString($recept))->first()->id;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->recept = $this->receptToString($recept);
            $pizzaalias->save();
            $this->storePizzaForSite($data,$this->websiteid);
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
                    "receptreadable"=>$this->receptToReadableString($recept),
                    "rawid" => $data->id,
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
    public function setProcessID(Request $request){

        $request->session()->put('processID', $request->processID);
        return back();
    }

    public function processRaw(Request $request){

        $id = $request->session()->get('processID');
        $this->websiteid= $request->session()->get('processID');
        if($id == null){
            return;
        }
        $sitedata = RawPizza::all()->where('website_id',$id);

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
            return back();
        };
        $material = new Material();
        $material->name = $errordata;
        $material->save();
        $alias = new MaterialAlias();
        $alias->material_id = $material->id;
        $alias->name = $errordata;
        $alias->save();
        LogManager::shared()->addLog("Új material hozzáadva: ". $material->name);
        return redirect('/dashboard/process');
    }

    public function newMaterialAlias(Request $request){
        $newalias = $request->newalias; // select
        $errordata = $request->errordata;
        $alias = new MaterialAlias();
        $alias->material_id = $newalias;
        $alias->name = $errordata;
        $alias->save();
        LogManager::shared()->addLog("Új material alias: ". $alias->name);
        return redirect('/dashboard/process');
    }
    public function newPizza(Request $request){

        $errordata = $request->errordata;
        $rawid = $request->rawid;
        $this->websiteid= $request->session()->get('processID');
        $req = Pizza::all()->where('name',$errordata)->first();
        if($req != null){
            return back();
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
        $this->storePizzaForSite(null,$this->websiteid,$alias, $rawid);
        LogManager::shared()->addLog("Új pizza: ". $alias->name);
        return redirect('/dashboard/process');
    }

    public function newPizzaAlias(Request $request){
        $rawid = $request->rawid;
        $pizzaalias = new PizzaAlias();
        $pizzaalias->recept= $request->recept;
        $pizzaalias->name = $request->errordata;
        $pizzaalias->pizzaid = $request->newalias;
        $pizzaalias->save();
        $this->storePizzaForSite(null,$this->websiteid,$pizzaalias, $rawid);
        LogManager::shared()->addLog("Új pizza alias: ". $pizzaalias->name);
        return redirect('/dashboard/process');
    }

    public function refreshPizzaAliasRecept(){
       $data = PizzaAlias::all()->where('recept',null);
       foreach ($data as $dat) {
         $dat->recept = Pizza::all()->where('id',$dat->pizzaid)->first()->recept;
         $dat->save();
       }
    }
    public function JoinPizzas(Request $request){

        $main = $request->input('toselect');
        $from = $request->input('fromselect');
        if($main == $from){
            return back();
        }
        if($from == 1){
            return back();
        }
        $pizzaaliases = PizzaAlias::all()->where('pizzaid',$from);
        foreach($pizzaaliases as $pizzaalias){
            $pizzaalias->pizzaid = $main;
            $pizzaalias->save();
        }
        $deletable = Pizza::all()->where('id',$from)->first();
        if($deletable != null){
           $deletable->delete();
        }
        return back();
    }
    public function JoinMaterials(Request $request){

        $main = $request->input('toselect');
        $from = $request->input('fromselect');
        if($main == $from){
            return back();
        }
        if($from == 1){
            return back();
        }
        $materialaliases = MaterialAlias::all()->where('material_id',$from);
        foreach($materialaliases as $materialalias){
            $materialalias->material_id = $main;
            $materialalias->save();
        }
        $deletable = Material::all()->where('id',$from)->first();
        if($deletable != null){
           $deletable->delete();
        }
        $upldateables = Pizza::where('recept', 'like', '%['.$from.',%')->get();

        foreach($upldateables as $updateable){
            $updateable->recept = str_replace("[".$from.",","[".$main.",",$updateable->recept);
            $updateable->save();
        }
        $upldateables = Pizza::where('recept', 'like', '%,'.$from.',%')->get();

        foreach($upldateables as $updateable){
            $updateable->recept =  str_replace(",".$from.",",",".$main.",",$updateable->recept);
            $updateable->save();
        }
        $upldateables = Pizza::where('recept', 'like', '%,'.$from.']%')->get();;
        foreach($upldateables as $updateable){
            $updateable->recept =  str_replace(",".$from."]",",".$main."]",$updateable->recept);
            $updateable->save();
        }
        return back();
    }
}
