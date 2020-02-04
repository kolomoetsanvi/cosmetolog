<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableCosmetologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cosmetologies', function (Blueprint $table) {
            $table->string('title',255);

            $table->bigInteger('cities_id')->unsigned();
            $table->foreign('cities_id')->references('id')->on('cities');

            $table->bigInteger('districts_id')->unsigned();
            $table->foreign('districts_id')->references('id')->on('districts');

            $table->string('address',255);
            $table->string('phone',255)->nullable();
            $table->string('work_schedule',255)->nullable();
            $table->string('site',255)->nullable();
            $table->string('e_mail',255)->nullable();
            $table->text('brief')->nullable();
            $table->string('vk',255)->nullable();
            $table->string('ok',255)->nullable();
            $table->string('fb',255)->nullable();
            $table->string('inst',255)->nullable();
            $table->bigInteger('views_numb')->unsigned();
            $table->text('maps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cosmetologies', function (Blueprint $table) {
            //
        });
    }
}
