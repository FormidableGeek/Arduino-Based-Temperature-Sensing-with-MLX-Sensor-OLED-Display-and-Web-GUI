<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThermometerReadings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        schema::create("thermometer_readings",function (Blueprint $table){
$table->id();
$table->foreignId('user_id')->constrained("users")->onDelete("cascade");
$table->float("readings");
$table->string("picture")->default('thermometer.svg');
$table->timestamps();
$table->softDeletes();

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
        schema::disableForeignKeyConstraints();
           schema::dropIfExists("thermometer_readings");        //
    }
    
}

