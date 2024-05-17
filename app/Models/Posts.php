<?php

namespace App\Models;


use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelLike\Traits\Likeable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model implements CanVisit
{
    use HasFactory;
    use HasVisits;
    use Likeable;
    use Favoriteable;


    public $table = "posts";

    protected $fillable = [
    'user_id','poster',
    'text','type','post_Time',
    'image','ishark','activecomments','country',
    'tv_id','tawsiat_tv_id','cast_id','cast_id_2','views','state'];


    public function poste_user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function poste_comments(){
        return $this->hasMany(Comments::class,'post_id','id');
    }

    public function poste_cartoon(){
        return $this->hasOne(TV::class,'id','tv_id');
    }

    public function poste_cartoon_mosabih(){
        return $this->hasOne(TV::class,'id','tawsiat_tv_id');
    }


    public function poste_cast(){
        return $this->hasOne(Cast::class,'id','cast_id');
    }

    public function poste_cast_tani(){
        return $this->hasOne(Cast::class,'id','cast_id_2');
    }

    public function Views()
    {
        return $this->hasMany(visitjcartoon::class, 'post_id', 'id');
    }


}
