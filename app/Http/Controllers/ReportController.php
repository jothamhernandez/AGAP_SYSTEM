<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Exports\EventReport;


class ReportController extends Controller
{
    //
    public function index(Request $request){
        
        $events = Event::with(['paid'=>function($q){
            $q->whereNotIn('user_id',explode(',',env("EXEMPTED_USERS",'5')));
        },'registered'=>function($q){
            $q->whereNotIn('user_id',explode(',',env("EXEMPTED_USERS",'5')));
        }])->get();
        return view('pages.reports')->with('events',$events);
    }

    public function export(Request $request, $event_id){
        $event = Event::find($event_id);
        return \Excel::download(new EventReport($event_id), $event->title . '-List-' . \Carbon\Carbon::now() . '.xlsx');
    }
}
