<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableReportCosmetologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cosmetologies_reports', function (Blueprint $table) {
            $table->bigInteger('cosmetologies_id')->unsigned();
            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cosmetologies_reports', function (Blueprint $table) {
            //
        });
    }
}
