<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Analytics;
use Spatie\Analytics\Period;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        /*
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        return $analyticsData; */
        return view('dashboard.dashboard');
    }


}
