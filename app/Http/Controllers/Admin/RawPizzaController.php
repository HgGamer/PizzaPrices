<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RawPizza;
use App\Websites;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\Helper\LogManager;

class RawPizzaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deleteAll()
    {

        RawPizza::truncate();

        return redirect()->route('links.index')
                        ->with('success','All raw pizza deleted successfully');
    }

    public function deletePizzas(String $websiteId)
    {

        RawPizza::where('website_id', $websiteId)->delete();

        $msg = 'All raw pizza for website id: ' .  $websiteId  . ' deleted successfully';

        return redirect()->route('links.index')
                        ->with('success', $msg);
    }

    public function banyaiPizzaFeltetLoad(){

        $count = RawPizza::where('website_id', '=', 26)->count();

        if ($count < 1) {
            return redirect()->route('links.index')
            ->with('danger','Sikertelen, mert a Bányai cukrászdához nincsenek jelenleg pizzák.');
        }

        \Artisan::call('db:seed',['--class' => 'BanyaiCukraszdaFeltetUpdater']);

        return redirect()->route('links.index')
            ->with('success','Banyai Cukraszda toppings added.');
    }

    public function forzaitaliaPizzaLoad(){

        \Artisan::call('db:seed',['--class' => 'ForzaitaliaPizzaLoader']);


         return redirect()->route('links.index')
         ->with('success','Forza Italia pizzas added.');
}

    public function happyhotPizzaLoad(){

        \Artisan::call('db:seed',['--class' => 'HappyHotPizzaLoader']);


        return redirect()->route('links.index')
        ->with('success','Happy Hot pizzas added.');
    }

    public function pizzafaloPizzaLoad(){

        \Artisan::call('db:seed',['--class' => 'PizzaFaloPizzaLoader']);


        return redirect()->route('links.index')
        ->with('success','Pizza Falo pizzas added.');
    }

    public function fortePizzaLoad(){

        try {
            $client = new GuzzleClient();
            $request = $client->get('https://ted.pizzaforte.hu/product/pizzak/32-cm?lang=hu');
            $response = $request->getBody();
        } catch (\Exception $e) {
            LogManager::shared()->addLog("Forte Pizzák lekérés error: " . $e);
            return redirect()->route('links.index')
                ->with('success','Pizza Forte pizzas FAILED.');
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

        return redirect()->route('links.index')
        ->with('success','Pizza Forte pizzas added.');
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

            if(isset($checkExist->id)) {
                $rawPizza = RawPizza::find($checkExist->id);

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

        return redirect()->route('links.index')
        ->with('success','Pizza Margareta pizzas added.');
    }


    function contains($substring, $longString) {
        return strpos($longString, $substring) !== false;
    }

}
