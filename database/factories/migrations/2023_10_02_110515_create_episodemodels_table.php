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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('lebel')->nullable();
            $table->string('tv_id');
            $table->string('season_id');
            $table->string('quality')->nullable();
            $table->string('size')->nullable();
            $table->string('source')->nullable();
            $table->string('url')->nullable();
            $table->text('url_modablaj')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->nullable();

            $table->string('processed_file')->nullable();
            $table->boolean('processed')->default(false);
            $table->string('processing_percentage')->nullable();

            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
