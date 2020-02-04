<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTablePromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->bigInteger('cosmetologies_id')->unsigned();
            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');

            $table->bigInteger('services_id')->unsigned();
            $table->foreign('services_id')->references('id')->on('services');

            $table->date('start');
            $table->date('end');
            $table->double('new_cost');
            $table->string('img',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotions', function (Blueprint $table) {
            //
        });
    }
}
