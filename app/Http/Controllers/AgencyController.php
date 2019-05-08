<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;

class AgencyController extends Controller
{
    //

    public function index(){
        $agencies = Agency::with('department')->get();
        
        return view('pages.agency',['agencies'=>$agencies]);
    }
}
