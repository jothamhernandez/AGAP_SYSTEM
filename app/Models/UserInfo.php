<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $fillable = ['user_id'];


    public function agency(){
        return $this->belongsTo('App\Models\Agency', 'agency_id','id');
    }
}
