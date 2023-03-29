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
        Schema::create('roomBedclothes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservation')->onDelete('cascade');

            $table->boolean('pillow');
            $table->boolean('duvet');
            $table->boolean('bedsheet');
            $table->boolean('bedclothes');

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
        Schema::dropIfExists('roomBedclothes');
    }
};
