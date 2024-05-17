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
        Schema::create('ads_centers', function (Blueprint $table) {
            $table->id();
            $table->string('link_dialog_ads')->nullable();
            $table->string('image_dialog_ads')->nullable();
            $table->string('end_date_dialog_ads')->nullable();
            $table->string('visibility_dialog_ads')->nullable();


            $table->string('link_home_banner_ads')->nullable();
            $table->string('image_home_banner_ads')->nullable();
            $table->string('end_date_home_banner_ads')->nullable();
            $table->string('visibility_home_banner_ads')->nullable();


            $table->string('link_episodes_banner_ads')->nullable();
            $table->string('image_episodes_banner_ads')->nullable();
            $table->string('end_date_episodes_banner_ads')->nullable();
            $table->string('visibility_episodes_banner_ads')->nullable();


            $table->string('link_search_banner_ads')->nullable();
            $table->string('image_search_banner_ads')->nullable();
            $table->string('end_date_search_banner_ads')->nullable();
            $table->string('visibility_search_banner_ads')->nullable();


            $table->string('link_player_banner_ads')->nullable();
            $table->string('image_player_banner_ads')->nullable();
            $table->string('end_date_player_banner_ads')->nullable();
            $table->string('visibility_player_banner_ads')->nullable();


            $table->string('link_comics_banner_ads')->nullable();
            $table->string('image_comics_banner_ads')->nullable();
            $table->string('end_date_comics_banner_ads')->nullable();
            $table->string('visibility_comics_banner_ads')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_centers');
    }
};
