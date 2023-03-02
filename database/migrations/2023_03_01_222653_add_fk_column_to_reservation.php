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
        Schema::table('reservation', function (Blueprint $table) {
            $table->unsignedBigInteger('guest_room_id')->nullable()->after('room_id');
            $table->foreign('guest_room_id')->references('id')->on('guest_rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropForeign('reservation_guest_room_id_foreign');
            $table->dropColumn('guest_room_id');
        });
    }
};
