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
        Schema::create('tv', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('poster')->nullable();
            $table->integer('year')->nullable();
            $table->string('place')->nullable();
            $table->string('gener')->nullable();
            $table->string('whereistartcomics')->nullable();
            $table->string('cover')->nullable();
            $table->string('age')->nullable();
            $table->text('story')->nullable();
            $table->string('mortabit_id')->nullable();
            $table->string('tmdb_id')->nullable();
            $table->string('other_season_id')->nullable();
            $table->string('link_id')->nullable();
            $table->integer('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv');
    }
};
