<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Category;
use App\ItemSchema;
use App\Lib\Scraper;
use App\Link;
use App\Website;
use App\RawPizza;
use App\RawPizzaHistory;
use Mail;
use GuzzleHttp\Client as GuzzleClient;
use App\Helper\LogManager;

use function PHPUnit\Framework\isNull;

class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $links = Link::orderBy('id', 'DESC')->paginate(10);

        $itemSchemas = ItemSchema::all();

        return view('dashboard.link.index')->withLinks($links)->withItemSchemas($itemSchemas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $websites = Website::all();

        return view('dashboard.link.create')->withCategories($categories)->withWebsites($websites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
            'main_filter_selector' => 'required',
            'website_id' => 'required',
            'category_id' => 'required'
        ]);

        $link = new Link;

        $link->url = $request->input('url');

        $link->main_filter_selector = $request->input('main_filter_selector');

        $link->website_id = $request->input('website_id');

        $link->category_id = $request->input('category_id');

        $link->save();

        return redirect()->route('links.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::all();
        $websites = Website::all();

        return view('dashboard.link.edit')->withLink(Link::find($id))->withCategories($categories)->withWebsites($websites);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required',
            'main_filter_selector' => 'required',
            'website_id' => 'required',
            'category_id' => 'required'
        ]);

        $link = Link::find($id);

        $link->url = $request->input('url');

        $link->main_filter_selector = $request->input('main_filter_selector');

        $link->website_id = $request->input('website_id');

        $link->category_id = $request->input('category_id');

        $link->save();

        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);
        $link->delete();

        return redirect()->route('links.index')
                        ->with('success','Link deleted successfully');
    }


    /**
     * @param Request $request
     */
    public function setItemSchema(Request $request)
    {
        if(!$request->item_schema_id && !$request->link_id)
            return;

        $link = Link::find($request->link_id);

        $link->item_schema_id = $request->item_schema_id;

        $link->save();

        return response()->json(['msg' => 'Link updated!']);
    }
    /**
     * scrape all link
     *
     * @param Request $request
     */
    public function scrapeAll(Request $request)
    {
        set_time_limit(3600);

        $links = Link::all();

        foreach($links as $link){
            if(empty($link->main_filter_selector) && (empty($link->item_schema_id) || $link->item_schema_id == 0)) {
                break;
            }
            $scraper = new Scraper(new Client());
            $scraper->handle($link);
        }

        /* Statikus nem scrapelhető dolgok */

        $this->banyaiPizzaFeltetLoad();

        $forzaItaliaCount = RawPizza::where('website_id', 29)->count();
        if ($forzaItaliaCount < 1) {
            $this->forzaitaliaPizzaLoad();
        }

        $faloCount = RawPizza::where('website_id', 30)->count();
        if ($faloCount < 1) {
            $this->pizzafaloPizzaLoad();
        }

        $happyHotCount = RawPizza::where('website_id', 31)->count();
        if ($happyHotCount < 1) {
            $this->happyhotPizzaLoad();
        }
        

        /* From external apis */
        $this->fortePizzaLoad();
        $this->margaretaPizzaLoad();

        /* Scrapelés utáni de még feldolgozás előtti korrekciok */
        if($link->website_id == 27){
            $this->sliceTrojaPizzaSizes();
        }else if ($link->website_id == 15) {
            $this->correctPizzaMonsterData();
        } else if ($link->website_id == 10) {
            $this->correctTesztahazData();
        }

        $this->generateScrapeReport();

        return response()->json(['status' => 1, 'msg' => 'Scraping done']);

    }

    /**
     * scrape specific link
     *
     * @param Request $request
     */
    public function scrape(Request $request)
    {
        if(!$request->link_id)
            return;

        $link = Link::find($request->link_id);

        if(empty($link->main_filter_selector) && (empty($link->item_schema_id) || $link->item_schema_id == 0)) {
            return;
        }

        $scraper = new Scraper(new Client());

        $scraper->handle($link);

        /* Scrapelés utáni de még feldolgozás előtti korrekciok */
        if($link->website_id == 27){
            $this->sliceTrojaPizzaSizes();
        }else if ($link->website_id == 15) {
            $this->correctPizzaMonsterData();
        } else if ($link->website_id == 10) {
            $this->correctTesztahazData();
        }

        if($scraper->status == 1) {
            return response()->json(['status' => 1, 'msg' => 'Scraping done']);
        } else {
            return response()->json(['status' => 2, 'msg' => $scraper->status]);
        }
    }

    public function loadRawDataHistoryTable(){
        RawPizzaHistory::truncate();
        $rawPizzas = RawPizza::all();

        foreach ($rawPizzas as $rawPizza) {
            $rawPizzaHistory = New RawPizzaHistory();
            $rawPizzaHistory->id = $rawPizza->id;
            $rawPizzaHistory->title = $rawPizza->title;
            $rawPizzaHistory->size = $rawPizza->size;
            $rawPizzaHistory->price = $rawPizza->price;
            $rawPizzaHistory->content = $rawPizza->content;
            $rawPizzaHistory->image = $rawPizza->image;
            $rawPizzaHistory->source_link = $rawPizza->source_link;
            $rawPizzaHistory->category_id = $rawPizza->category_id;
            $rawPizzaHistory->website_id = $rawPizza->website_id;
            $rawPizzaHistory->created_at = $rawPizza->created_at;
            $rawPizzaHistory->updated_at = $rawPizza->updated_at;
            $rawPizzaHistory->save();
        }

        return 1;
    }

    public function sendEmail($newWebsitesData, $newPizzas, $priceChangedPizzas){
        $userName = "";
        $userName = auth()->user()->name;

        if (!isNull($userName) || !isset($userName)){
            $userName = "Pizza Prices Bot";
        }

        $to_name = "All admin";
        $to_email = "korsos.tibor9b@gmail.com";
        $data = array('name'=>$userName, 'newWebsitesData' => $newWebsitesData, 'newPizzas'=> $newPizzas, 'priceChangedPizzas' => $priceChangedPizzas);
        Mail::send('emails.ScrapeReport', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->cc("chudi.richard@gmail.com", $to_name)
        ->cc("sipos22@msn.com", $to_name)
        ->subject("Scrape Report");
        $message->from("pizzapricesbot@gmail.com",'Pizza Prices Jarvis');
        });
    }

    public function generateScrapeReport(){
            $newWebsitesData = Website::all();
            foreach ($newWebsitesData as $newWebsiteData) {
                 $newWebsiteData['oldPizzasCount'] = RawPizzaHistory::where('website_id', $newWebsiteData->id)->count();
                 $newWebsiteData->raw_data_number = RawPizza::where('website_id', $newWebsiteData->id)->count();
                 if ($newWebsiteData->raw_data_number - $newWebsiteData->oldPizzasCount > 0) {
                    $newWebsiteData['pieceDiferrence'] = "More pizza";
                 }elseif ($newWebsiteData->raw_data_number - $newWebsiteData->oldPizzasCount < 0) {
                    $newWebsiteData['pieceDiferrence'] = "Less Pizza";
                 }else{
                    $newWebsiteData['pieceDiferrence'] = "No change";
                 }

            }

            $rawPizzas = RawPizza::all();
            $newPizzas = [];
            $priceChangedPizzas = [];

            $i = 0;
            foreach ($rawPizzas as $rawPizza) {
                $rawPizzaHistory =  RawPizzaHistory::where("website_id", $rawPizza->website_id)->where('title',$rawPizza->title)->where('size',$rawPizza->size)->first();
                $website = Website::find($rawPizza->website_id);

                if (isset($rawPizzaHistory)){
                    if($rawPizzaHistory->price != $rawPizza->price){
                        $priceChangedPizzas[$i] = $rawPizza;
                        $priceChangedPizzas[$i]["websiteName"] = $website->title;
                        $priceChangedPizzas[$i]["newPrice"] = $rawPizza->price;
                        $priceChangedPizzas[$i]["oldPrice"] = $rawPizzaHistory->price;
                        $priceChangedPizzas[$i]["priceDiferrence"] = $rawPizza->price - $rawPizzaHistory->price;
                    }
                }else{
                    $rawPizza["websiteName"] = $website->title;
                    $newPizzas[] = $rawPizza;
                }
                $i++;
            }

            $this->sendEmail($newWebsitesData, $newPizzas, $priceChangedPizzas);

            //Lementi a pizzérákhoz a RawPizzak szamat
            $websitesData = Website::all();
            foreach ($websitesData as $website) {
                $website->raw_data_number =  RawPizza::where('website_id', $website->id)->count();
                $website->save();
            }

           $this->loadRawDataHistoryTable();

            return "Siker";
    }

    public function sliceTrojaPizzaSizes(){
        $pizzas = RawPizza::where('website_id', 27)->get();

        foreach ($pizzas as $pizza) {
            $pizza->size = $this->findFirstTwoNumericFromBack($pizza->title);
            $pizza->save();
        }

        //valami gecis lamakun nem pizza szoval purgálom
        //de ezt akár átlehet huzni valami pre processbe ha létezik
        $lamacunPizza = RawPizza::where('website_id', 27)
                        ->where('title', "Lamacun")->first();

        if ($lamacunPizza != null) {
            $lamacunPizza->delete();
        }

        return $pizzas;
    }

    private function findFirstTwoNumericFromBack($string){
        $hitCounter = 0;
        $reverseResult = "";
        $stringArray = str_split($string);
        for ($i=count($stringArray)-1; $i >= 0; $i--) {
            if (is_numeric($stringArray[$i])) {
                $hitCounter++;
                $reverseResult = $reverseResult. $stringArray[$i];
                if ($hitCounter > 1){
                    return strrev($reverseResult);
                }
             }
        }
        return strrev($reverseResult);
    }

    private function correctPizzaMonsterData(){
        $pizzas = RawPizza::where('website_id', 15)->get();

        foreach ($pizzas as $pizza) {
            $pizza->content = "Paradicsomos alap, " . $pizza->content;
            $pizza->save();
        }
    }

    private function correctTesztahazData() {
        $pizzas = RawPizza::where('website_id', 10)->get();

        foreach ($pizzas as $pizza) {
            $pizza->title = substr($pizza->title, 6);
            $pizza->save();
        }
    }

    public function banyaiPizzaFeltetLoad(){

        \Artisan::call('db:seed',['--class' => 'BanyaiCukraszdaFeltetUpdater']);
    }

    public function forzaitaliaPizzaLoad(){

        \Artisan::call('db:seed',['--class' => 'ForzaitaliaPizzaLoader']);
}

    public function happyhotPizzaLoad(){

        \Artisan::call('db:seed',['--class' => 'HappyHotPizzaLoader']);

    }

    public function pizzafaloPizzaLoad(){

        \Artisan::call('db:seed',['--class' => 'PizzaFaloPizzaLoader']);
    }

    public function fortePizzaLoad(){
        try {
            $client = new GuzzleClient();
            $request = $client->get('https://ted.pizzaforte.hu/product/pizzak/32-cm?lang=hu');
            $response = $request->getBody();
        } catch (\Exception $e) {
            LogManager::shared()->addLog("Forte Pizzák lekérés error: " . $e);
            return redirect()->route('links.index')
                ->with('success','Pizza Forte pizzas failed.');
        }

        $jsonData = json_decode($response);

        
        foreach ($jsonData as $pizzaData) {
            $checkExist = RawPizza::where('title', $pizzaData->name)
                                ->where('website_id', 28)
                                ->first();

            if(isset($checkExist->id)) {
                $rawPizza = RawPizza::find($checkExist->id);

                $rawPizza->title = $pizzaData->name;

                $rawPizza->size = $pizzaData->size;

                $rawPizza->price = $pizzaData->price;

                $i = 0;
                $feltetek = "";
                foreach ($pizzaData->ingredients as $material) {
                    $feltetek = $feltetek . ($i == 0 ? "" : ", ") . $material->name . ($material->type == "sauce" ? " alap" : "");
                    $i++;
                }

                $rawPizza->content = $feltetek;

                $rawPizza->image = "";

                $rawPizza->source_link = "";

                $rawPizza->category_id = 3;

                $rawPizza->website_id = 28;

                $rawPizza->save();
            } else {
                $rawPizza = new RawPizza;

                $rawPizza->title = $pizzaData->name;

                $rawPizza->size = $pizzaData->size;

                $rawPizza->price = $pizzaData->price;

                $i = 0;
                $feltetek = "";
                foreach ($pizzaData->ingredients as $material) {
                    $feltetek = $feltetek . ($i == 0 ? "" : ", ") . $material->name . ($material->type == "sauce" ? " alap" : "");
                    $i++;
                }

                $rawPizza->content = $feltetek;

                $rawPizza->image = "";

                $rawPizza->source_link = "";

                $rawPizza->category_id = 3;

                $rawPizza->website_id = 28;

                $rawPizza->save();
            }

        }
    }

    public function margaretaPizzaLoad(){
        try {
            $client = new GuzzleClient();
            $request = $client->get('https://api.wixrestaurants.com/v2/organizations/1342300161528252/full');
            $response = $request->getBody();
        } catch (\Exception $e) {
            LogManager::shared()->addLog("Margareta Pizzák lekérés error: " . $e);
            return "$e";
            return redirect()->route('links.index')
                ->with('success','Pizza Margareta pizzas FAILED.');
        }

        $jsonData = json_decode($response, true, JSON_UNESCAPED_SLASHES);

        $pizzasData = $jsonData['menu']['items'];


        foreach ($pizzasData as $pizzaData) {
            if (!isset($pizzaData['price'])) {
                continue;
            }
            if ($pizzaData['price'] < 100000) {
                continue;
            } else if ($pizzaData['price'] > 300000) {
                continue;
            }

            if ($this->contains('Predella', $pizzaData['title']['hu_HU']) || $this->contains('Garrone', $pizzaData['title']['hu_HU'])) { 
                continue;
            }

            $pizzaName  = explode(" | ", $pizzaData['title']['hu_HU'])[0];

            $checkExist = RawPizza::where('title', $pizzaName)
                                ->where('website_id', 21)
                                ->first();

            if(isset($checkExist->id)) {
                $rawPizza = RawPizza::find($checkExist->id);

                $rawPizza->title = $pizzaName;

                $rawPizza->size = "32";

                $price = (string)($pizzaData['price'] / 100);

                $rawPizza->price = $price;

                $feltetek = explode(" | ", $pizzaData['description']['hu_HU'])[0];

                $feltetek = str_replace(" +",",", $feltetek);

                $rawPizza->content = $feltetek;

                $rawPizza->image = "";

                $rawPizza->source_link = "";

                $rawPizza->category_id = 3;

                $rawPizza->website_id = 21;

                $rawPizza->save();

            } else {
                $rawPizza = new RawPizza;

                $name  = explode(" | ", $pizzaData['title']['hu_HU'])[0];

                $rawPizza->title = $name;

                $rawPizza->size = "32";

                $price = (string)($pizzaData['price'] / 100);

                $rawPizza->price = $price;

                $feltetek = explode(" | ", $pizzaData['description']['hu_HU'])[0];

                $feltetek = str_replace(" +",",", $feltetek);

                $rawPizza->content = $feltetek;

                $rawPizza->image = "";

                $rawPizza->source_link = "";

                $rawPizza->category_id = 3;

                $rawPizza->website_id = 21;

                $rawPizza->save(); 
            }

        }
    }

    function contains($substring, $longString) {
        return strpos($longString, $substring) !== false;
    }

}
