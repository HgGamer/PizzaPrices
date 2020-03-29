<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Feedback;

class FeedbackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(50);

        return view('dashboard.feedback.index')->withFeedbacks($feedbacks);
    }

    public function deleteAll()
    {

        Feedback::truncate();

        return redirect()->route('feedbacks.index')
                        ->with('success','All feedbacks deleted successfully');
    }



}
