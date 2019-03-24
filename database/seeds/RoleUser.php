<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role_users')->insert([
            [
                'user_id'=>1,
                'role_id'=>1,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        ]);
    }
}
