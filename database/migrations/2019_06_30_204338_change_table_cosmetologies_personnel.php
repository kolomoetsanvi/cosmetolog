<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableCosmetologiesPersonnel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cosmetologies_personnel', function (Blueprint $table) {

            $table->bigInteger('cosmetologies_id')->unsigned();
            $table->foreign('cosmetologies_id')->references('id')->on('cosmetologies');

            $table->bigInteger('personnel_id')->unsigned();
            $table->foreign('personnel_id')->references('id')->on('personnel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cosmetologies_personnel', function (Blueprint $table) {
            //
        });
    }
}
