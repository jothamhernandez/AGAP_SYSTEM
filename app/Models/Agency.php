<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $fillable = ['sector','name','department_id','bsgc_status'];

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id');
    }
}
