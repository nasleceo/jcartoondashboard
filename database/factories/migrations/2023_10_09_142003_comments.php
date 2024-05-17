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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->text('content')->nullable();
            $table->string('tv_id')->nullable();
            $table->string('news_id')->nullable();
            $table->string('post_id')->nullable();
            $table->integer('ishark')->nullable();
            $table->string('statu')->nullable();
            $table->string('type')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
