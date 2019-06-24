<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Helpers extends Controller
{
    // 
    public function updateInstruction(Request $request){
        $user = $request->user();
        $user->done_instruction = true;
        $user->save();
    }
}
