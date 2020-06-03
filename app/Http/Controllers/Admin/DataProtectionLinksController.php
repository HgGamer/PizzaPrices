<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Lib\DataProtectionScraper;
use App\DataProtectionLink;
use App\ItemSchema;
use App\Category;
use App\Website;
use App\DataProtectionData;


class DataProtectionLinksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $links = DataProtectionLink::orderBy('id', 'DESC')->paginate(10);

        $itemSchemas = ItemSchema::all();

        return view('dashboard.data_protection_link.index')->withLinks($links)->withItemSchemas($itemSchemas);
    }

    public function create()
    {
        $categories = Category::all();
        $websites = Website::all();

        return view('dashboard.data_protection_link.create')->withCategories($categories)->withWebsites($websites);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
            'main_filter_selector' => 'required',
            'website_id' => 'required',
            'category_id' => 'required'
        ]);

        $link = new DataProtectionLink;

        $link->url = $request->input('url');

        $link->main_filter_selector = $request->input('main_filter_selector');

        $link->website_id = $request->input('website_id');

        $link->category_id = $request->input('category_id');

        $link->save();

        return redirect()->route('data_protection_links.index');
    }

    public function edit($id)
    {

        $categories = Category::all();
        $websites = Website::all();

        return view('dashboard.data_protection_link.edit')->withLink(DataProtectionLink::find($id))->withCategories($categories)->withWebsites($websites);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required',
            'main_filter_selector' => 'required',
            'website_id' => 'required',
            'category_id' => 'required'
        ]);

        $link = DataProtectionLink::find($id);

        $link->url = $request->input('url');

        $link->main_filter_selector = $request->input('main_filter_selector');

        $link->website_id = $request->input('website_id');

        $link->category_id = $request->input('category_id');

        $link->save();

        return redirect()->route('data_protection_links.index');
    }

    public function setItemSchema(Request $request)
    {
        if(!$request->item_schema_id && !$request->link_id)
            return;

        $link = DataProtectionLink::find($request->link_id);

        $link->item_schema_id = $request->item_schema_id;

        $link->save();

        return response()->json(['msg' => 'Data Protection Link updated!']);
    }

    public function destroy($id)
    {
        $link = DataProtectionLink::find($id);
        $link->delete();

        return redirect()->route('data_protection_links.index')
                        ->with('success','Link deleted successfully');
    }

    public function scrapeAll(Request $request)
    {
        set_time_limit(3600);

        /*
        //Egy lekérés kezdete
        $link = DataProtectionLink::where('url', "https://pizzaforte.hu/assets/files/privacy.html")->first();


        if(empty($link->main_filter_selector) && (empty($link->item_schema_id) || $link->item_schema_id == 0)) {
            Log::debug("hibaaaa");
            return ;
        }
        $scraper = new DataProtectionScraper(new Client());
        $result = $scraper->handle($link);

        Log::debug($result['text'][0]);

        return response()->json(['status' => 1, 'msg' => 'Scraping done']);
        // Egy lekérdezés vége
        */

        //Összes lekérdezés kezdete
        $links = DataProtectionLink::all();

        foreach($links as $link){
            if(empty($link->main_filter_selector) && (empty($link->item_schema_id) || $link->item_schema_id == 0)) {
                break;
            }
            $scraper = new DataProtectionScraper(new Client());
            $result = $scraper->handle($link);
            /*
            Log::debug($result);

            return response()->json(['status' => 1, 'msg' => 'Scraping done']);
            */
            $model = DataProtectionData::where('url', $link['url'])
                ->where('website_id', $link['website_id'])
                ->first();

            if(isset($model->id)){
                //létezik már
                $newHash = md5($result['text'][0]);
                if($model->data == $newHash){
                    //ha ugyanaz a hash
                    //Nincs teendő, csak megkell nyugodni
                    Log::debug('Ugyanaz a hash');
                }else{
                    //Változott a Hash: panic!
                    Log::debug('Valtozott a hash');
                    $model->data = $newHash;
                    $model->save();
                    $link->upToDate = 0;
                    $link->save();
                }


            }else{
                $dataModel = new DataProtectionData();

                $dataModel->url = $link['url'];
                $dataModel->data = md5($result['text'][0]);
                $dataModel->website_id = $link['website_id'];
                $dataModel->save();
            }


        }

        return response()->json(['status' => 1, 'msg' => 'Scraping done']);

    }

    public function readIt($id){
        $dataProtectionModel = DataProtectionLink::find($id);

        if($dataProtectionModel != null){
            $dataProtectionModel->upToDate = 1;
            $dataProtectionModel->save();
        }

        return redirect()->route('data_protection_links.index')
                        ->with('success','Link updated successfully');
    }


}
