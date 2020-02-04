<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableReportSearches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_reports', function (Blueprint $table) {
            $table->bigInteger('cities_id')->unsigned();
            $table->foreign('cities_id')->references('id')->on('cities');

            $table->bigInteger('districts_id')->unsigned();
            $table->foreign('districts_id')->references('id')->on('districts');

            $table->bigInteger('services_id')->unsigned();
            $table->foreign('services_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_reports', function (Blueprint $table) {
            //
        });
    }
}
