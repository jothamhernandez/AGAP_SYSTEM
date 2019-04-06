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
}
