<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('x');
            $table->string('y');
            $table->string('width');
            $table->string('height');
            $table->string('neighbors');
            $table->string('confidence');
            $table->string('positionX');
            $table->string('positionY');
            $table->string('offsetX');
            $table->string('offsetY');
            $table->string('scaleX');
            $table->string('scaleY');
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
        Schema::dropIfExists('faces');
    }
}
