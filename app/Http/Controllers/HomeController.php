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

    public function index()
    {
        return view('welcome');
    }

    public function home(){

        $paginatedData = $this->getInfinitPizzas();

        return view('home')->withPizzas($paginatedData->getCollection())->withMaxLoad($paginatedData->lastPage())->withPaginatedBy($paginatedData->perPage());
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


}
