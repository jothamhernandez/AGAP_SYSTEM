<?php

namespace App\Observers;

use App\User;
use App\Models\UserInfo;
use App\Models\RoleUser;

class UserObserver
{
    //

    public function created(User $user){
        UserInfo::create(['user_id'=>$user->id]);
        RoleUser::create(['user_id'=>$user->id,'role_id'=>4]);
    }
}
