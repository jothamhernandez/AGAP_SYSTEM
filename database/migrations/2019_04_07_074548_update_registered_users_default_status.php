<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegisteredUsersDefaultStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::table('registered_users', function(Blueprint $table){
        //     $table->enum('status',['Pending','Rejected','Unpaid','Paid','Cancelled'])->default('Unpaid')->change();
        // });
        DB::statement("ALTER TABLE registered_users CHANGE COLUMN `status` `status` ENUM('Pending','Rejected','Unpaid','Paid','Cancelled') DEFAULT 'Unpaid' ");
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
