<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Comments extends Model
{
    use HasFactory;
    use Likeable;


    public $table = "comments";

    protected $fillable = [
        'user_id','content','tv_id','post_id','news_id',
        'ishark','statu','type'];


        public function user(){
            return $this->hasOne(User::class,'id','user_id');
        }

        public function poste(){
            return $this->hasOne(Posts::class,'id','post_id');
        }

        public function news(){
            return $this->hasOne(News::class,'id','news_id');
        }

        public function replay(){
            return $this->hasMany(replay::class,'comment_id','id');
        }



}
