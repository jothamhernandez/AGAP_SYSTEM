<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\UserInfo;

class FixUserInfoNameCasing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $data = UserInfo::all();
        $data->each(function($user){
            $user->first_name = ucwords(mb_strtolower($user->first_name));
            $user->last_name = ucwords(mb_strtolower($user->last_name));
            $user->middle_name = ucwords(mb_strtolower($user->middle_name));
            $user->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
