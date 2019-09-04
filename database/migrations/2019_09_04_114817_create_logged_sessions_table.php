
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggedSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logged_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('ip_address');
            $table->string('country_name')->nullable();
            $table->string('country_code');
            $table->string('region_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('iso_code')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('metro_code')->nullable();
            $table->string('area_code')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logged_sessions');
    }
}
