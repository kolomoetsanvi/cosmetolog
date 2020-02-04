<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCosmetologiesPersonnel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetologies_personnel', function (Blueprint $table) {
            $table->bigIncrements('id');

//            $table->integer('cosmetologies_id')->unsigned();
//            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');
//
//            $table->integer('personnel_id')->unsigned();
//            $table->foreign('personnel_id')->references('id')->on('personnel');

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
        Schema::dropIfExists('cosmetologies_personnel');
    }
}
