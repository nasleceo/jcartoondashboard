<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class episodemodel extends Model
{
    use HasFactory;


    protected $table = "episodes";

    protected $fillable = ['lebel','tv_id','season_id','quality','size',
    'source','url','url_modablaj','message','status','type','imageofepe_url'
    ,'processed_file','processed','processing_percentage','skip_available','intro_start','intro_end'];


    public static function getepisodecount($tv_id, $season_id) {
       return episodemodel::where(['tv_id' => $tv_id, 'season_id' => $season_id ])->count();
    }

    
    public function video_quality(){
        return $this->hasMany(server::class,'epe_id','id');
    }

    public function video_cartoon(){
        return $this->hasOne(TV::class,'id','tv_id');
    }

    public function video_season(){
        return $this->hasOne(SeasonModel::class,'id','season_id');
    }


}
