<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adsCenter extends Model
{
    use HasFactory;




    protected $table = "ads_centers";

    protected $fillable = [
        'link_dialog_ads',
        'image_dialog_ads',
        'end_date_dialog_ads',
        'visibility_dialog_ads',

        'link_home_banner_ads',
        'image_home_banner_ads',
        'end_date_home_banner_ads',
        'visibility_home_banner_ads',

        'link_episodes_banner_ads',
        'image_episodes_banner_ads',
        'end_date_episodes_banner_ads',
        'visibility_episodes_banner_ads',


        'link_search_banner_ads',
        'image_search_banner_ads',
        'end_date_search_banner_ads',
        'visibility_search_banner_ads',


        'link_player_banner_ads',
        'image_player_banner_ads',
        'end_date_player_banner_ads',
        'visibility_player_banner_ads',

        'link_comics_banner_ads',
        'image_comics_banner_ads',
        'end_date_comics_banner_ads',
        'visibility_comics_banner_ads',
        ];
}
