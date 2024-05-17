<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allvideos extends Model
{
    use HasFactory;


    protected $table = "videomanager";


    protected $fillable = ['lebel','movie_id','source','url','url_modablaj','message','status','type'];

    public function video_quality(){
        return $this->hasMany(server::class,'epe_id','id');
    }


}
