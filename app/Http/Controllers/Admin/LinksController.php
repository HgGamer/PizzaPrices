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
use DB;

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

        if($link->website_id == 27){
            $this->sliceTrojaPizzaSizes();
        }else if ($link->website_id == 15) {
            $this->correctPizzaMonsterData();
        }

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

        if($link->website_id == 27){
            $this->sliceTrojaPizzaSizes();
        }else if ($link->website_id == 15) {
            $this->correctPizzaMonsterData();
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
        $message->from("pizzaprice11bot@gmail.com",'Jarvis');
        });
    }

    public function generateScrapeReport(){
            $newWebsitesData = Website::all();
            foreach ($newWebsitesData as $newWebsiteData) {
                 $newWebsiteData['oldPizzasCount'] = RawPizzaHistory::where('website_id', $newWebsiteData->id)->count();
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
            foreach ($websites as $website) {
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
        $lamacunPizza->delete();

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


}
