<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableCitiesDistrics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities_districts', function (Blueprint $table) {

            $table->bigInteger('cities_id')->unsigned();
            $table->foreign('cities_id')->references('id')->on('cities');

            $table->bigInteger('districts_id')->unsigned();
            $table->foreign('districts_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities_districts', function (Blueprint $table) {
            //
        });
    }
}
