<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Analytics;
use Spatie\Analytics\Period;
use App\Log;

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

        $visitorsAndPageViews = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $logsCount = Log::all()->count();

        return view('dashboard.dashboard')->withVisitorsAndPageViews($visitorsAndPageViews[0])->withLogsCount($logsCount);
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
