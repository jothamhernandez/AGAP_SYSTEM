<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['title','description','header_image','start','end'];

    public function fee_status(){
        return $this->hasOne('App\Models\RegisteredUser','event_id');
    }
    
    public function registered(){
        return $this->hasMany('App\Models\RegisteredUser', 'event_id');
    }

    public function pending(){
        return $this->hasMany('App\Models\RegisteredUser','event_id')->where('supporting_doc','!=',null)->where('status','Pending');
    }

    public function paid(){
        return $this->hasMany('App\Models\RegisteredUser', 'event_id')->where('status','Paid');
    }

    public function fund(){
        $total = 0;
        $paid = $this->paid()->whereNotIn('user_id',explode(',',env("EXEMPTED_USERS",'5')))
        ->get();
        $paid->map(function($payee) use(&$total){
            $total += $payee->fee->fee;
        });
        return $total;
        // return
    }
}
