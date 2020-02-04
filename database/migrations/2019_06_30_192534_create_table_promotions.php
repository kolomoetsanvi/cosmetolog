<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');

//            $table->integer('cosmetologies_id')->unsigned();
//            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');
//
//            $table->integer('services_id')->unsigned();
//            $table->foreign('services_id')->references('id')->on('services');
//
//            $table->date('start');
//            $table->date('end');
//            $table->double('new_cost');
//            $table->string('img',255);

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
        Schema::dropIfExists('promotions');
    }
}
