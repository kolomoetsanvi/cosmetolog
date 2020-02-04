<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCosmetologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetologies', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->string('title',255);

//            $table->integer('cities_id')->unsigned();
//            $table->foreign('cities_id')->references('id')->on('cities');
//
//            $table->integer('districts_id')->unsigned();
//            $table->foreign('districts_id')->references('id')->on('districts');

//            $table->string('address',255);
//            $table->string('phone',255)->nullable();
//            $table->string('work_schedule',255)->nullable();
//            $table->string('site',255)->nullable();
//            $table->string('e_mail',255)->nullable();
//            $table->text('brief')->nullable();
//            $table->string('vk',255)->nullable();
//            $table->string('ok',255)->nullable();
//            $table->string('fb',255)->nullable();
//            $table->string('inst',255)->nullable();


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
        Schema::dropIfExists('cosmetologies');
    }
}
