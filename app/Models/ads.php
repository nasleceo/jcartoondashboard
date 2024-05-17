<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ads extends Model
{
    use HasFactory;



    protected $table = "ads";

    protected $fillable = [
        'ad_type',
        'Admob_Publisher_ID',
        'Admob_APP_ID',
        'adMob_Native',
        'adMob_Banner',
        'adMob_Interstitial',
        'StartApp_App_ID',
        'facebook_app_id',
        'facebook_banner_ads_placement_id',
        'facebook_interstitial_ads_placement_id',
        'AdColony_app_id',
        'AdColony_banner_zone_id',
        'AdColony_interstitial_zone_id',
        'unity_game_id',
        'unity_banner_id',
        'unity_interstitial_id',
        'custom_banner_url',
        'custom_banner_click_url_type',
        'custom_banner_click_url',
        'custom_interstitial_url',
        'custom_interstitial_click_url_type',
        'custom_interstitial_click_url',
        'applovin_sdk_key',
        'applovin_apiKey' ,
        'applovin_Banner_ID',
        'applovin_Interstitial_ID',
        'ironSource_app_key'];



}
