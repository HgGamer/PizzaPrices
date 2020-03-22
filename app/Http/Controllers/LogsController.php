<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Log;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logs = Log::orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.log.index')->withLogs($logs);
    }

    public function destroy($id)
    {
        $log = Log::find($id);
        $log->delete();

        return redirect()->route('logs.index')
                        ->with('success','Log deleted successfully');
    }

    public function deleteAll()
    {

        Log::truncate();

        return redirect()->route('logs.index')
                        ->with('success','All logs deleted successfully');
    }

}
