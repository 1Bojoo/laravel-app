<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dormId');
            $table->string('roomNum');
            $table->integer('floor')->default(0);
            $table->unsignedBigInteger('userID')->nullable();
            $table->boolean('isOwned');
            $table->timestamps();
            $table->foreign('dormId')->references('id')->on('dormitory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_rooms');
    }
};
