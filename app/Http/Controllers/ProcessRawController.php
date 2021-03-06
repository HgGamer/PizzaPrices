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
use App\Additionalmaterial;
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

    public function getAllNewMaterial(){
        $newmaterials = [];
        $rawPizzas = RawPizza::all();
        $materialAliases = MaterialAlias::all()->pluck('name')->toArray();

        foreach($rawPizzas as $rawpizza){
            $proc = new ContentProcess();
            $content = $proc->sliceContent($rawpizza->website_id, $rawpizza->content);

            foreach($content as $material){
                if(!in_array($material, $newmaterials)){
                    if(!in_array($material, $materialAliases)){
                        array_push($newmaterials,$material);
                    }
                }
            }
        }
        return $newmaterials;
    }

    public function checkRecepts(){
        $pizzas = Pizza::all();
        foreach ($pizzas as $pizza) {

            $old = explode(",",substr(substr_replace($pizza->recept, '', 0, 1), 0, -1));
            $old = array_unique($old);
            sort($old);
            $old = ('['.implode(",",$old).']');

            if($old!=$pizza->recept){
                $pizza->recept = $old;
                $pizza->save();
                LogManager::shared()->addLog('nem rendezett pizza'.$pizza->id);
            }
        }
        $pizzas = PizzaAlias::all();
        foreach ($pizzas as $pizza) {

            $old = explode(",",substr(substr_replace($pizza->recept, '', 0, 1), 0, -1));
            $old = array_unique($old);
            sort($old);
            $old = ('['.implode(",",$old).']');

            if($old!=$pizza->recept){
                $pizza->recept = $old;
                $pizza->save();
                LogManager::shared()->addLog('nem rendezett pizza_alias'.$pizza->id);
            }
        }

    }


    private function processContent($sitedata,$websiteid){
        //az ??sses pizza materialjait n??zi ismeri e
        foreach($sitedata as $datarow){
            if($datarow['content'] == ""){
                RawPizza::all()->where('id',$datarow['id'])->first()->delete();
                LogManager::shared()->addLog("Recept t??rl??se, content ??res");
            }
            $content = ($this->sliceContent($websiteid,$datarow['content']));
            $recept = $this->processContentRow($content);
            $additional = $this->processContentRow($content,true);
        }

        //v??gig megy??nk a pizz??kon is
        foreach($sitedata as $datarow){
            $content = ($this->sliceContent($websiteid,$datarow['content']));

            $recept = $this->processContentRow($content);

            $additional = $this->processContentRow($content,true);
            $processedPizza = $this->processPizza($datarow,$recept,$additional);
            if($processedPizza==-1){
                $failed = true;
                return false;
            }
        }

        //ezen a ponton a pizz??k receptjeit ??s a pizz??kat is ismerj??k, felt??ltj??k a store databest a weboldal idj??vel ??s pizza ??rakkal
        foreach($sitedata as $datarow){
            $additional = $this->processContentRow($content,true);
            $this->storePizzaForSite($datarow,$websiteid,$additional);
        }

    }

    private function storePizzaForSite($data,$websiteid,$additional, $alias = null, $rawid = null){
        try{
            $storedata = new StoreData();
            $storedata->websiteid = $websiteid;
            $storedata->additonal = $this->receptToString($additional);
            if($alias == null){
                $alias = PizzaAlias::all()->where('name',$this->escapePizzaName($data->title))->first();
            }else{
                $data = RawPizza::all()->where('id',$rawid)->first();
            }


            if(in_array(1, explode(",",substr(substr_replace($alias->recept, '', 0, 1), 0, -1)))){
                return;
            }
            $pizzaid =$alias->pizzaid;

            if($pizzaid == 1){
                return;
            }


            //benne van e a dbben ez a pizza?
            if(StoreData::all()->where('websiteid',$websiteid)->where('pizzaid',$pizzaid)->where('pizzasize',$data->size)->count()!=0){
                //m??r a dbben van a pizza
                //dd('m??r benne van storedat??ba');
                if(RawPizza::all()->where('id',$data['id'])->first() != null){
                    RawPizza::all()->where('id',$data['id'])->first()->delete();
                }
                return;
            }


            $storedata->pizzaid = Pizza::all()->where('id',$pizzaid)->first()->id;
            $storedata->pizzaAliasId = $alias->id;
            $storedata->price =  intval($data->price);
            $storedata->pizzasize = preg_replace('/[^0-9]/', '', $data->size);
            $storedata->url = RawPizza::all()->where('id',$data['id'])->first()->source_link;
            $storedata->save();
            LogManager::shared()->addLog("??j pizza storehoz adva: ".$alias->name);


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

        $recept = array_unique($recept);
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
                LogManager::shared()->addLog("receptToReadableString, material null, ilyennek nem k??ne el??fordulnia");
            }

        }
        return $ret;
    }

    private function escapePizzaName($pizzaname){
        $pizzaname = mb_strtolower($pizzaname);
        $esapables  = ["\"", "32cm", "32 cm", "26 cm", "30 cm", "30cm" , "30", "pizza", "()",];
        foreach ($esapables as $escape) {
            $pizzaname = str_replace($escape,"",$pizzaname);
        }
        $pizzaname =  preg_replace('/(\d*\.)/', "", $pizzaname);
        $pizzaname = trim($pizzaname);
        return $pizzaname;
    }

    private function processPizza($data,$recept,$additional){
        $pizza = $this->escapePizzaName($data['title']);
        if(trim($pizza) == ""){
            return;
        }
        //ismert a n??v hopp?? ismerj??k
        if(PizzaAlias::all()->where('name',$pizza)->count()!=0){
            if(PizzaAlias::all()->where('name',$pizza)->first()->recept == $this->receptToString($recept)){
                return;
            }
            if(PizzaAlias::all()->where('recept',$this->receptToString($recept))->count()!=0){
                //ezt ismerj??k valamelyik alias receptje alapj??n
                $originalaias = PizzaAlias::all()->where('recept',$this->receptToString($recept))->first();
                if($originalaias->name == $pizza){
                    if( $originalaias->pizzaid == 1){
                        //dd('skippen van');
                    }
                    return;
                }
                $pizzaalias = new PizzaAlias();
                $pizzaalias->name = $pizza;
                $pizzaalias->pizzaid = $originalaias->pizzaid;
                $pizzaalias->recept = $this->receptToString($recept);
                $pizzaalias->save();
                $this->storePizzaForSite($data,$this->websiteid,$additional);
                LogManager::shared()->addLog("??j pizza alias : ". $pizzaalias->name);
                return;
            }
            $id = PizzaAlias::all()->where('name',$pizza)->first()->pizzaid;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->recept = $this->receptToString($recept);
            $pizzaalias->save();
            $this->storePizzaForSite($data,$this->websiteid,$additional);
            LogManager::shared()->addLog("??j pizza alias (??j recepttel) : ". $pizzaalias->name);
            return;
        }
        //csekkolni hogy l??teik e a recept m??s n??ven.
        if(Pizza::all()->where('recept',$this->receptToString($recept))->count()!=0){
            LogManager::shared()->addLog("Ezt a pizz??t m??r recept alapj??n ismerj??k, ".$pizza);
            //kell a pizza idje az aliashoz

            $id = Pizza::all()->where('recept',$this->receptToString($recept))->first()->id;
            $pizzaalias = new PizzaAlias();
            $pizzaalias->name = $pizza;
            $pizzaalias->pizzaid = $id;
            $pizzaalias->recept = $this->receptToString($recept);
            $pizzaalias->save();
            $this->storePizzaForSite($data,$this->websiteid,$additional);
            return;
        }
        //benne van e #skipp#
        if(is_array($recept)){
            if(in_array(1, $recept)){
                return;
            }
        }

        //ha nem sz??lunk a felhaszn??l??nak:
        $dat = (array(
                    "message" => "unknown pizza",
                    "data" => $pizza,
                    "recept"=>$this->receptToString($recept),
                    "receptreadable"=>$this->receptToReadableString($recept),
                    "additional"=>$additional,
                    "rawid" => $data->id,
                ));
        array_push($this->returnData,$dat);
        return -1;

    }

    private function processAdditionalMaterial($material)
    {

        if(Additionalmaterial::all()->where("name",$material)->count()== 0){

            if(MaterialAlias::all()->where("name",$material)->count()== 0){
                $dat = (array("message" => "unknown material","data" => $material));
                array_push($this->returnData,$dat);
                // nem ismerj??k a materialt
                return -1;
            }else{
                return null;
            }
        }else{
            //ismerj??k a materialt

            return (Additionalmaterial::all()->where("name",$material)->first()->id);
        }

    }
    private function processMaterial($material){
        if(MaterialAlias::all()->where("name",$material)->count()== 0){
            if(Additionalmaterial::all()->where("name",$material)->count()== 0){
                $dat = (array("message" => "unknown material","data" => $material));
                array_push($this->returnData,$dat);
                // nem ismerj??k a materialt
                return -1;
            }else{
                return null;
            }
        }else{
            //ismerj??k a materialt
            return (MaterialAlias::all()->where("name",$material)->first()->material_id);
        }

    }


    /**
     * @param $content content
     * @return array $recept
     */
    private function processContentRow($content,$isAdditional = false){
        $recept = [];
        $failed = false;
        foreach($content as $material){
            if($isAdditional){
                $processedMaterial = $this->processAdditionalMaterial($material);

            }else{
                $processedMaterial = $this->processMaterial($material);
            }
            if($processedMaterial==-1){
                $failed = true;
                return false;
            }else{
                if($processedMaterial != null){
                    array_push($recept,$processedMaterial);
                }
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
        LogManager::shared()->addLog("??j material hozz??adva: ". $material->name);
        return "ok";
    }
    public function newAdditionalMaterial(Request $request){
        $errordata = $request->errordata;
        $material = new Additionalmaterial();
        $material->name = $errordata;
        $material->save();
        LogManager::shared()->addLog("??j additional material hozz??adva: ". $material->name);
        return back();
    }

    public function newMaterialAlias(Request $request){
        $newalias = $request->newalias; // select
        $errordata = $request->errordata;
        $alias = new MaterialAlias();
        $alias->material_id = $newalias;
        $alias->name = $errordata;
        $alias->save();
        LogManager::shared()->addLog("??j material alias: ". $alias->name);
        return redirect('/dashboard/process');
    }
    public function newPizza(Request $request){

        $errordata = $request->errordata;
        $additional = $request->additional;
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
        $this->storePizzaForSite(null,$this->websiteid,$additional,$alias, $rawid);
        LogManager::shared()->addLog("??j pizza: ". $alias->name);
        return redirect('/dashboard/process');
    }

    public function newPizzaAlias(Request $request){
        $rawid = $request->rawid;
        $this->websiteid= $request->session()->get('processID');
        $additional = $request->additional;
        $pizzaalias = new PizzaAlias();
        $pizzaalias->recept= $request->recept;
        $pizzaalias->name = $request->errordata;
        $pizzaalias->pizzaid = $request->newalias;
        $pizzaalias->save();
        $this->storePizzaForSite(null,$this->websiteid,$additional,$pizzaalias, $rawid);
        LogManager::shared()->addLog("??j pizza alias: ". $pizzaalias->name);
        return redirect('/dashboard/process');
    }


    public function deleteBadAliases(){
        $ids = [];
        $materials = Material::all();
        foreach ($materials as $material) {
            array_push($ids,$material->id);
        }
        $pizzaAliases = PizzaAlias::all();

        foreach ($pizzaAliases as $pizzalias) {
            $p_ids = json_decode($pizzalias->recept);
            if($pizzalias->recept == '[]' || $pizzalias->recept == null){
                LogManager::shared()->addLog("PizzaAlias fura recepttel ".$pizzalias->name );
            }else{
                foreach ($p_ids as $id) {
                    if (!in_array($id, $ids)) {
                        LogManager::shared()->addLog("PizzaAlias t??rl??se ismeretlen recept miatt.".$pizzalias->name . "material: ".$id);
                        $pizzalias->delete();
                    }
                }
            }

        }
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

        $upldateables = PizzaAlias::where('recept', 'like', '%['.$from.',%')->get();

        foreach($upldateables as $updateable){
            $updateable->recept = str_replace("[".$from.",","[".$main.",",$updateable->recept);
            $updateable->save();
        }
        $upldateables = PizzaAlias::where('recept', 'like', '%,'.$from.',%')->get();

        foreach($upldateables as $updateable){
            $updateable->recept =  str_replace(",".$from.",",",".$main.",",$updateable->recept);
            $updateable->save();
        }
        $upldateables = PizzaAlias::where('recept', 'like', '%,'.$from.']%')->get();;
        foreach($upldateables as $updateable){
            $updateable->recept =  str_replace(",".$from."]",",".$main."]",$updateable->recept);
            $updateable->save();
        }


        return back();
    }

}
