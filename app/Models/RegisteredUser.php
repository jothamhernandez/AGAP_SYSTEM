<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisteredUser extends Model
{
    //

    public function fee(){
        return $this->belongsTo('App\Models\EventFee', 'fee_id');
    }
}
