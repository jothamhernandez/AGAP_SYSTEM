<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventFee;
use App\Models\RegisteredUser;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{
    //
    public function view(Request $request, $id){
        $registeredUser = RegisteredUser::where(['user_id'=>$request->user()->id, 'event_id'=>$id])->first();
        // $registered = ($registeredUser != null) ? true : false;
        // dd($registeredUser);
        return view('pages.event_details')->with(['event'=>\App\Models\Event::find($id),'fees'=>\App\Models\EventFee::where('event_id', $id)->get(), 'registered'=>$registeredUser]);
    }

    public function register(Request $request, $id){

        $event = Event::find($id);
        $fee = EventFee::find($id);

        $registered = new RegisteredUser();
        $registered->event_id = $event->id;
        $registered->user_id = Auth::user()->id;
        $registered->fee_id = $fee->id;
        
        
        try {
            $registered->save();
            $status = ['class'=>'success','message'=>'successfully registered'];
        } catch (\Exception $e){
            $status = ['class'=>'warning','message'=>'failed to register'];
        }

        $referrer = $request->headers->get('referer');
        return redirect($referrer)->with($status);
        // echo "REGISTERING " . Auth::user()->username . " To " . $event->title . " with Fee of ". $fee->fee;
    }

    public function pay(Request $request, $id, $fee){
        $registeredUser = RegisteredUser::where(['event_id'=>$id,'user_id'=>$request->user()->id,'fee_id'=>$fee])->first();
        $event = Event::find($id);
        $referrer = $request->headers->get('referer');

        if(!$request->hasFile('supporting_docs')){
            $status = ['message'=>'please select a file', 'class'=>'warning'];
            return redirect($referrer)->with($status);
        }

        switch($request->supporting_docs->getMimeType()){
            case 'application/pdf':
                break;

            case 'image/jpeg':
                break;
            
            case 'image/png':
                break;

            default: 
                $status = ['message'=>'invalid file format', 'class'=>'danger'];
                return redirect($referrer)->with($status);
        }

        // $validator = Validator::make($request->all(), [
        //     'supporting_docs'=>
        // ]);


        if($request->hasFile('supporting_docs')){
            $registeredUser->supporting_doc = $request->supporting_docs->store($event->title . '/deposit_slips');
            $registeredUser->status = 'Pending';
            $status = ['message'=>'document successfully submitted', 'class'=>'success'];
            $registeredUser->save();
        } else {
            $status = ['message'=>'submission of document failed', 'class'=>'warning'];
        }  

        return redirect($referrer)->with($status);
    }

    public function materials(Request $request, $id){
        
        $id = decrypt($id);

        $event = Event::find($id);


        return view('generator.qrcode')->with(['event'=>$event]);
    }

    public function demo(Request $request, $url){
        $event = ['title'=>'Event Title','start'=>\Carbon\Carbon::now()->subDay(1),'event_materials_link'=>$url];
        $event = json_decode(json_encode($event), false);
        return view('generator.qrcode')->with(['event'=>$event]);
    }
    
    public function validator_page($event_id){
        $event_id = decrypt($event_id);

        $event = Event::find($event_id);

        return view('validator.validator-page',['event'=>$event]);
    }

    public function validator($event_id, $code){
        $event_id = decrypt($event_id);
        $events = RegisteredUser::where('event_id', $event_id)->get();
        $valid = $events->filter(function($event) use($code){
            $user_code = substr(md5($event->id . $event->user_id), 10, 5);
            return $code == $user_code;
        })->values()[0];
        
        $user = User::find($valid->user_id);

        if($valid->count() > 0){
            $response = ['message'=>'welcome', 'user'=>$user->info];

        } else {
            $response = ['message'=>'not valid code'];
        }

        return response()->json($response);
    }
}
