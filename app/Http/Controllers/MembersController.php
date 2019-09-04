<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    //

    public function dashboard(Request $request){
        // dd($request->ip());
        $sessions = \App\Models\LoggedSessions::where(['user_id'=>$request->user()->id])->orderBy('created_at','desc')->get();
        
        return view('pages.dashboard',['sessions'=>$sessions]);
    }
}
