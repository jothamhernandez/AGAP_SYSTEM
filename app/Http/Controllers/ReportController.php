<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\RegisteredUser;

class ReportController extends Controller
{
    //
    public function index(Request $request){
        
        $events = Event::with(['paid','registered'])->get();
        return view('pages.reports')->with('events',$events);
    }
}
