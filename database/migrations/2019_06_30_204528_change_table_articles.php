<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title',255);
            $table->text('content');
            $table->bigInteger('views_numb')->unsigned();

            $table->bigInteger('cosmetologies_id')->unsigned()->nullable();
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
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
