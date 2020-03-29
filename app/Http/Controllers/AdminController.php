<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Analytics;
use Spatie\Analytics\Period;
use App\StoreData;
use App\Log;
use App\RawPizza;
use App\Feedback;

class AdminController extends Controller
{

    public $analytics;

    public function __construct()
    {
       $this->middleware('auth');
       $this->analytics = Analytics::getAnalyticsService();

    }

    public function index()
    {

        $visitorsAndPageViews7 = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $visitorsAndPageViews30 = Analytics::fetchVisitorsAndPageViews(Period::days(30));
        $logsCount = Log::all()->count();

       $pizzasCount = StoreData::all()->count();
       $rawPizzasCount = RawPizza::all()->count();
       $feedBacks= Feedback::latest('created_at')->take(5)->get();

        return view('dashboard.dashboard')
                    ->withVisitorsAndPageViews7($visitorsAndPageViews7[0])
                    ->withVisitorsAndPageViews30($visitorsAndPageViews30[0])
                    ->withLogsCount($logsCount)
                    ->withPizzasCount($pizzasCount)
                    ->withRawPizzasCount($rawPizzasCount)
                    ->withFeedbacks($feedBacks);
    }

    public function customGoogleQuery(){
        $response = Analytics::performQuery(Period::days(7),  'ga:users,ga:pageviews',  ['dimensions' => 'ga:date,ga:pageTitle'] );

        return collect($response['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'visitors' => (int) $dateRow[1],
                'pageViews' => (int) $dateRow[2],
            ];
        });
    }



}
