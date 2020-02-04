<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReportSearches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_reports', function (Blueprint $table) {
            $table->bigIncrements('id');

//            $table->integer('cities_id')->unsigned();
//            $table->foreign('cities_id')->references('id')->on('cities');
//
//            $table->integer('districts_id')->unsigned();
//            $table->foreign('districts_id')->references('id')->on('districts');
//
//            $table->integer('services_id')->unsigned();
//            $table->foreign('services_id')->references('id')->on('services');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_reports');
    }
}
