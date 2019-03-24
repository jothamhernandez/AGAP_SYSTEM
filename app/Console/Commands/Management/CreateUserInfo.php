<?php

namespace App\Console\Commands\Management;

use Illuminate\Console\Command;
use App\Models\UserInfo;

class CreateUserInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:create {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $user_id = $this->argument('user_id');

        UserInfo::create(['user_id'=>$user_id]);
        
    }
}
