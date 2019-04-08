<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\RegisteredUser;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NotifyEventStatus;
use App\User;

class PaymentController extends Controller
{
    //

    public function review(Request $request, $event_id){
        $event = Event::where('id', $event_id)->with('registered')->first();
        return view('pages.payment-review')->with(['event'=>$event]);
    }

    public function paid(Request $request, $registered_id){
        $registered = RegisteredUser::find($registered_id);

        if($registered->status == "Pending" && $request->input('status') == "Rejected"){
            Storage::delete($registered->supporting_doc);
            $registered->supporting_doc = null;
        }

        if($request->input('status') == "Paid"){
            $user = User::find($registered->user_id);
            $user->notify(new NotifyEventStatus($registered));
        }

        if($registered->status == $request->input('status')){
            $status = ['message'=>'there has been no changes on status', 'class'=>'warning'];
        } else {
            $registered->status = $request->input('status');
            $status = ['message'=>'status successfully updated','class'=>'success'];
        }
        // $registered->save();

        $referrer = $request->headers->get('referer');
        return redirect($referrer)->with($status);
    }
}
