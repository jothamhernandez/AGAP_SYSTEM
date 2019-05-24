<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $fillable = ['user_id','first_name','last_name','middle_name','birthdate','gender','agency_id'];


    public function agency(){
        return $this->belongsTo('App\Models\Agency', 'agency_id')->with('department');
    }

    public function fullname(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
