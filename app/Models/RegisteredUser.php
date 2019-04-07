<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisteredUser extends Model
{
    //

    public function fee(){
        return $this->belongsTo('App\Models\EventFee', 'fee_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function event(){
        return $this->belongsTo('App\Models\Event', 'event_id');
    }
}
