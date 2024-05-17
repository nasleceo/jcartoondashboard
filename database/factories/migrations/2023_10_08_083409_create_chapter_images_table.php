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
        Schema::create('chaptersImages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('chapter_id')->nullable();
            $table->string('comic_id')->nullable();
            $table->string('direct_link')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chaptersImages');
    }
};
