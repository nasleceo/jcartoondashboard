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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('poster')->nullable();
            $table->text('text')->nullable();
            $table->string('type')->nullable();
            $table->date('post_Time')->nullable();
            $table->string('image')->nullable();
            $table->integer('ishark')->nullable();
            $table->integer('activecomments')->nullable();
            $table->string('tv_id')->nullable();
            $table->string('tawsiat_tv_id')->nullable();
            $table->string('cast_id')->nullable();
            $table->string('cast_id_2')->nullable();
            $table->integer('views')->nullable();
            $table->string('state')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
