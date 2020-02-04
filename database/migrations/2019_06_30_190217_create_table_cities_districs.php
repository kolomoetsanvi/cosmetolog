<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCitiesDistrics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_districts', function (Blueprint $table) {
            $table->bigIncrements('id');

//            $table->integer('cities_id')->unsigned();
//            $table->foreign('cities_id')->references('id')->on('cities');
//
//            $table->integer('districts_id')->unsigned();
//            $table->foreign('districts_id')->references('id')->on('districts');


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
        Schema::dropIfExists('cities_districts');
    }
}
