<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Agency;

class AccountController extends Controller
{
    public function __construct(UserInfo $user)
    {  
        $this->userInfo = $user; 
    }
    //
    public function information(Request $request){
        $accountInformation = $this->userInfo->with('agency')->find($request->user()->id);
        $agencies = Agency::all();
        return view('pages.account', ['user_info'=>$accountInformation, 'agencies' => $agencies]);
    }

    public function update_information(Request $request){
        $info = $request->all();
        unset($info['_token']);
        $this->userInfo->find($request->user()->id)->update($info);
        return redirect($request->headers->get('referer'));
    }
}
