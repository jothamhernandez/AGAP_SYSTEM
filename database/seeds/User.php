<?php

use Illuminate\Database\Seeder;
use App\User as UserModel;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $value = [
                [
                    'username'=>'jotham19',
                    'email'=>'jotham_hernandez@hotmail.com',
                    'password'=>bcrypt('Admin123456*'),
                    'api_token'=>str_random(16)
                ]
            ];

        collect($value)->each(function($user){
            UserModel::create($user);
        });

        $users = factory(App\User::class, 15)->make()->toArray();

        foreach($users as $user){
            UserModel::create($user);
        }
    }   
}
