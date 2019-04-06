<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventFee;
use App\Models\RegisteredUser;

class EventController extends Controller
{
    //
    public function view(Request $request, $id){
        $registeredUser = RegisteredUser::where(['user_id'=>$request->user()->id, 'event_id'=>$id])->first();
        // $registered = ($registeredUser != null) ? true : false;

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

        if($request->hasFile('supporting_docs')){
            $registeredUser->supporting_doc = $request->supporting_docs->store('deposit_slips');
            $status = ['message'=>'document successfully submitted', 'class'=>'success'];
            $registeredUser->save();
        } else {
            $status = ['message'=>'submission of document failed', 'class'=>'warning'];
        }  

        


        $referrer = $request->headers->get('referer');
        return redirect($referrer)->with($status);
    }
}
