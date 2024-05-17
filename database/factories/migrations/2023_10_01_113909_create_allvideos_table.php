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
        Schema::create('videomanager', function (Blueprint $table) {
            $table->id();
            $table->string('lebel')->nullable();
            $table->string('movie_id')->nullable();
            $table->string('quality')->nullable();
            $table->string('size')->nullable();
            $table->string('source')->nullable();
            $table->string('url')->nullable();
            $table->text('url_modablaj')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->nullable();
            $table->string('type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videomanager');
    }
};
