<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentColumnOnAgencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('agencies', function(Blueprint $table){
            $table->unsignedBigInteger('department_id')->nullable();
            $table->enum('bsgc_status',['non-bsgc','bsgc']);
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::table('agencies', function(Blueprint $table){
            $table->dropColumn('department_id');
        });
    }
}
