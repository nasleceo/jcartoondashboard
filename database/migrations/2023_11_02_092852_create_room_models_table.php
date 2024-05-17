<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('who_create_room_user_id')->nullable();
            $table->string('invitaion_code')->nullable();
            $table->integer('conversation_id')->nullable();
            $table->date('time_creted')->nullable();
            $table->string('tv_id')->nullable();
            $table->string('season_id')->nullable();
            $table->string('epe_id')->nullable();
            $table->string('type_ispublic_private')->nullable();
            $table->integer('number_limit')->nullable();
            $table->integer('users_live_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
