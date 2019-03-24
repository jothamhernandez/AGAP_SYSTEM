<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


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
}
