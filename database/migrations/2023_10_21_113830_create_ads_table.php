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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('ad_type')->nullable();
            $table->string('Admob_Publisher_ID')->nullable();
            $table->string('Admob_APP_ID')->nullable();
            $table->string('adMob_Native')->nullable();
            $table->string('adMob_Banner')->nullable();
            $table->string('adMob_Interstitial')->nullable();
            $table->string('StartApp_App_ID')->nullable();
            $table->string('facebook_app_id')->nullable();
            $table->string('facebook_banner_ads_placement_id')->nullable();
            $table->string('facebook_interstitial_ads_placement_id')->nullable();
            $table->string('AdColony_app_id')->nullable();
            $table->string('AdColony_banner_zone_id')->nullable();
            $table->string('AdColony_interstitial_zone_id')->nullable();
            $table->string('unity_game_id')->nullable();
            $table->string('unity_banner_id')->nullable();
            $table->string('unity_interstitial_id')->nullable();
            $table->string('custom_banner_url')->nullable();
            $table->string('custom_banner_click_url_type')->nullable();
            $table->string('custom_banner_click_url')->nullable();
            $table->string('custom_interstitial_url')->nullable();
            $table->string('custom_interstitial_click_url_type')->nullable();
            $table->string('custom_interstitial_click_url')->nullable();
            $table->string('applovin_sdk_key')->nullable();
            $table->string('applovin_apiKey')->nullable();
            $table->string('applovin_Banner_ID')->nullable();
            $table->string('applovin_Interstitial_ID')->nullable();
            $table->string('ironSource_app_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
