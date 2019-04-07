<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Event;
use App\Models\EventFee;
use Carbon\Carbon;


class PageController extends Controller
{
    //
    public function members(Request $request){

        $members = User::query()
                        ->leftJoin('user_infos','users.id','=','user_infos.user_id')
                        ->leftJoin('role_users','role_users.user_id','=','users.id')
                        ->leftJoin('roles','roles.id','=','role_users.role_id');

        if(@$request->input('key'))
            $members->where('first_name','like','%'.$request->input('key').'%')
                    ->orWhere('last_name','like','%'.$request->input('key').'%')
                    ->orWhere('email','like','%'.$request->input('key').'%');


        $members->where('roles.role','Member');

        $members = $members->paginate(15);
        
        return view('pages.members')->with(['members'=>$members]);
    }

    public function events(Request $request){
        $events = Event::all();
        $myEvents = User::with('events')->find($request->user()->id);


        return view('pages.events')->with(['events'=>$events,'myEvents'=>$myEvents->events]);
    }
    
    public function add_event(Request $request){
        $data = $request->except(['header_image','_token','fee']);

        // dd($request->hasFile('header_image'));
        if($request->hasFile('header_image')){
            $data['header_image'] = $request->header_image->store($request->input('title').'/events_images');
        }

        // dd($data);

        if($event = Event::create($data)){
            // add to flash session response
            $event_fee = new EventFee();
            $event_fee->event_id = $event->id;
            $event_fee->description = "Regular Fee";
            $event_fee->fee = $request->fee;
            $event_fee->save();

            $response = ['success'=>'Event Successfully Created'];
        } else {
            // add to flash session response
            $response = ['error'=>'Cannot create event as of the moment'];
        }
        
        return redirect($request->headers->get('referer'))->with($response);
    }
}
