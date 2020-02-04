<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTablePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->bigInteger('cosmetologies_id')->unsigned();
            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');

            $table->bigInteger('services_id')->unsigned();
            $table->foreign('services_id')->references('id')->on('services');

            $table->double('cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            //
        });
    }
}
