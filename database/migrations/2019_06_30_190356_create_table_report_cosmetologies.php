<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReportCosmetologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetologies_reports', function (Blueprint $table) {
            $table->bigIncrements('id');

//            $table->integer('cosmetologies_id')->unsigned();
//            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');

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
        Schema::dropIfExists('cosmetologies_reports');
    }
}
