<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreData;
use App\Material;
use App\PizzaCategory;
use App\Traits\PizzaQueryTrait;
use App\Feedback;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    use PizzaQueryTrait ;

    public function __construct()
    {
        //$this->middleware('auth');
    }
    public  function errorindex(){

        return view('error');
    }

    public function index()
    {
        return view('welcome');
    }

    public function home(){

        $pizzas = $this->getInfinitPizzas();

        $pizzaOfTheMonthId = 608;
        $pizzaOfTheWeakId = 441;

        $monthPizza = StoreData::find($pizzaOfTheMonthId);
        $weekPizza = StoreData::find($pizzaOfTheWeakId);

        if($monthPizza == null){
            $monthPizza = StoreData::all()->random();
        }
        if($weekPizza == null){
            $weekPizza = StoreData::all()->random();
        }

        $monthPizza->pizza;
        $monthPizza->website;

        $weekPizza->pizza;
        $weekPizza->website;

        $receptekString = $monthPizza->pizza->recept;
        $materialObjects = $this->getMaterialObjects($receptekString);
        $monthPizza->recept = $this->orderMaterialObjects($materialObjects);

        $receptekString = $weekPizza->pizza->recept;
        $materialObjects = $this->getMaterialObjects($receptekString);
        $weekPizza->recept = $this->orderMaterialObjects($materialObjects);

        return view('home')->withPizzas($pizzas)->withPaginatedBy(10)->withMonthPizza($monthPizza)->withWeekPizza($weekPizza);
    }

    public function contacts(){

        return view('contacts');
    }

    public function pizzacategories(){

        $categories = PizzaCategory::orderBy('sorrend','ASC')->get();

        return view('pizzacategories')->withCategories($categories);
    }

    public function storeFeedback(Request $request){
            $this->validate($request, [
                'body' => 'required|max:512'
            ]);

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = [
                    'secret' => env('G_RECAPTCHA_SECRET_KEY'),
                    'response' => $request->get('recaptcha'),
                ];

            $options = [
                    'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                    ]
                ];

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $resultJson = json_decode($result);

            //Csak a legalább 2 ponttal rendelkező userek feedbackjét menti el
            if ($resultJson->success != true || $resultJson->score <= 0.2) {
                $response = array(
                    'status' => 'error',
                    'msg' => ['captcha' => 'ReCaptcha Error'],
                );
                return response()->json($response);
            }

            $feedback = new Feedback();

            $feedback->body = $request->input('body');

            $feedback->save();

            $response = array(
                'status' => 'success',
                'msg' => "Siker",
            );
            return response()->json($response);

    }

    private function getMaterialObjects($pizzaRecept){
        $receptekString = $pizzaRecept;

        $receptekString = substr(substr_replace($receptekString, '', 0, 1), 0, -1); // első utolsó karakter levágása

        $receptekString = explode(",",$receptekString); //tömbé konvertálás

        $materialObjects = array();

        foreach ($receptekString as $receptString) {
            $material = Material::find($receptString);
            if($material != null){
                $materialObjects[] =  $material;
            }else{
                $errorMSG =  "User::PizzasController, Show Material(id: " . $receptString . ")->Material is NULL";
                LogManager::shared()->addLog($errorMSG);
                continue;
            }
        }
        return $materialObjects;
    }

    private function orderMaterialObjects($materialObjects){
        $c = collect($materialObjects);

        $materialObjects = $c->sortBy('category_id')->values();

        $finalMaterialsArray = [];
        foreach ($materialObjects as $material) {
            if  (!isset($material->name)){
                continue;
            }
            $finalMaterialsArray[] = $material->name;
        }
        //Csak a neveket adja vissza tömbként
        return $finalMaterialsArray;
    }

}
