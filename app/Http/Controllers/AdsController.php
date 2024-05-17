<?php

namespace App\Http\Controllers;

use App\Models\ads;
use App\Models\adsCenter;
use Illuminate\Http\Request;

class AdsController extends Controller
{


    public function show(){

        $ads = ads::first();


        return View('layouts.ads.ads',compact('ads'));

    }

    public function alladsidandnative(){

        $ads = ads::first();
        $update = adsCenter::first();
        return response()->json(['adsID' => $ads,'adscenter' => $update]);

    }

    public function jcartoonads(){

        $update = adsCenter::first();
        if ($update->end_date_dialog_ads == date('Y-m-d')) {
            $update['visibility_dialog_ads'] = 0;
        }
        if ($update->end_date_home_banner_ads == date('Y-m-d')) {
            $update['visibility_home_banner_ads'] = 0;
        }
        if ($update->end_date_episodes_banner_ads == date('Y-m-d')) {
            $update['visibility_episodes_banner_ads'] = 0;
        }
        if ($update->end_date_search_banner_ads == date('Y-m-d')) {
            $update['visibility_search_banner_ads'] = 0;
        }
        if ($update->end_date_player_banner_ads == date('Y-m-d')) {
            $update['visibility_player_banner_ads'] = 0;
        }
        if ($update->end_date_comics_banner_ads == date('Y-m-d')) {
            $update['visibility_comics_banner_ads'] = 0;
        }



        if ($update['visibility_dialog_ads'] == 0) {

            $update['link_dialog_ads'] = null;
            $update['image_dialog_ads'] = null;
            $update['end_date_dialog_ads'] = null;

        }

        if ($update['visibility_home_banner_ads'] == 0) {

            $update['link_home_banner_ads'] = null;
            $update['image_home_banner_ads'] = null;
            $update['end_date_home_banner_ads'] = null;

        }


        if ($update['visibility_episodes_banner_ads'] == 0) {

            $update['link_episodes_banner_ads'] = null;
            $update['image_episodes_banner_ads'] = null;
            $update['end_date_episodes_banner_ads'] = null;

        }

        if ($update['visibility_search_banner_ads'] == 0) {

            $update['link_search_banner_ads'] = null;
            $update['image_search_banner_ads'] = null;
            $update['end_date_search_banner_ads'] = null;

        }

        if ($update['visibility_player_banner_ads'] == 0) {

            $update['link_player_banner_ads'] = null;
            $update['image_player_banner_ads'] = null;
            $update['end_date_player_banner_ads'] = null;

        }


        if ($update['visibility_comics_banner_ads'] == 0) {

            $update['link_comics_banner_ads'] = null;
            $update['image_comics_banner_ads'] = null;
            $update['end_date_comics_banner_ads'] = null;

        }






        $update->save();


        return View('layouts.ads.adscenter',compact('update'));

    }

    public function saveads(Request $request){

        $movie = ads::first();

        $movie['ad_type'] = $request->ad_type;
        $movie['Admob_Publisher_ID'] = $request->Admob_Publisher_ID;
        $movie['Admob_APP_ID'] = $request->Admob_APP_ID;
        $movie['adMob_Native'] = $request->adMob_Native;
        $movie['adMob_Banner'] = $request->adMob_Banner;
        $movie['adMob_Interstitial'] = $request->adMob_Interstitial;
        $movie['StartApp_App_ID'] = $request->StartApp_App_ID;
        $movie['facebook_app_id'] = $request->facebook_app_id;
        $movie['facebook_banner_ads_placement_id'] = $request->facebook_banner_ads_placement_id;
        $movie['facebook_interstitial_ads_placement_id'] = $request->facebook_interstitial_ads_placement_id;
        $movie['AdColony_app_id'] = $request->AdColony_app_id;
        $movie['AdColony_banner_zone_id'] = $request->AdColony_banner_zone_id;
        $movie['AdColony_interstitial_zone_id'] = $request->AdColony_interstitial_zone_id;
        $movie['unity_game_id'] = $request->unity_game_id;
        $movie['unity_banner_id'] = $request->unity_banner_id;
        $movie['unity_interstitial_id'] = $request->unity_interstitial_id;
        $movie['custom_banner_url'] = $request->custom_banner_url;
        $movie['custom_banner_click_url_type'] = $request->Custom_Banner_Click_Url_Type;
        $movie['custom_banner_click_url'] = $request->custom_banner_click_url;
        $movie['custom_interstitial_url'] = $request->custom_interstitial_url;
        $movie['custom_interstitial_click_url_type'] = $request->Custom_Interstitial_Click_Url_Type;
        $movie['custom_interstitial_click_url'] = $request->custom_interstitial_click_url;
        $movie['applovin_sdk_key'] = $request->applovin_sdk_key;
        $movie['applovin_apiKey'] = $request->applovin_apiKey;
        $movie['applovin_Banner_ID'] = $request->applovin_Banner_ID;
        $movie['applovin_Interstitial_ID'] = $request->applovin_Interstitial_ID;
        $movie['ironSource_app_key'] = $request->ironSource_app_key;

        $movie->save();

        return redirect()->route('adsview');

    }

    public function saveadsCenter(Request $request){

        $movie = adsCenter::first();

        $movie['link_dialog_ads'] = $request->link_dialog_ads;
        $movie['image_dialog_ads'] = $request->image_dialog_ads;
        $movie['end_date_dialog_ads'] = $request->end_date_dialog_ads;
        $movie['visibility_dialog_ads'] = 1;

        // if (gmdate("Y-m-d\TH:i:s\Z") == $request->end_date_dialog_ads) {
        //     $movie['visibility_dialog_ads'] = gmdate("Y-m-d\TH:i:s\Z");
        // }



        $movie['link_home_banner_ads'] = $request->link_home_banner_ads;
        $movie['image_home_banner_ads'] = $request->image_home_banner_ads;
        $movie['end_date_home_banner_ads'] = $request->end_date_home_banner_ads;
        $movie['visibility_home_banner_ads'] = $request->visibility_home_banner_ads;


        $movie['link_episodes_banner_ads'] = $request->link_episodes_banner_ads;
        $movie['image_episodes_banner_ads'] = $request->image_episodes_banner_ads;
        $movie['end_date_episodes_banner_ads'] = $request->end_date_episodes_banner_ads;
        $movie['visibility_episodes_banner_ads'] = $request->visibility_episodes_banner_ads;


        $movie['link_search_banner_ads'] = $request->link_search_banner_ads;
        $movie['image_search_banner_ads'] = $request->image_search_banner_ads;
        $movie['end_date_search_banner_ads'] = $request->end_date_search_banner_ads;
        $movie['visibility_search_banner_ads'] = $request->visibility_search_banner_ads;


        $movie['link_player_banner_ads'] = $request->link_player_banner_ads;
        $movie['image_player_banner_ads'] = $request->image_player_banner_ads;
        $movie['end_date_player_banner_ads'] = $request->end_date_player_banner_ads;
        $movie['visibility_player_banner_ads'] = $request->visibility_player_banner_ads;


        $movie['link_comics_banner_ads'] = $request->link_comics_banner_ads;
        $movie['image_comics_banner_ads'] = $request->image_comics_banner_ads;
        $movie['end_date_comics_banner_ads'] = $request->end_date_comics_banner_ads;
        $movie['visibility_comics_banner_ads'] = $request->visibility_comics_banner_ads;



        $movie->save();

        return redirect()->route('adsview');

    }


    public function jcartoonadsadvert(){

        $ads = ads::first();


        return View('layouts.ads.ads',compact('ads'));

    }

}
