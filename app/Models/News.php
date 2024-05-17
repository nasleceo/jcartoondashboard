<?php

namespace App\Models;

use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;


class News extends Model implements CanVisit
{
    use HasFactory;
    use HasVisits;
    use Favoriteable;



    public $table = "news";

    protected $fillable = [
    'title','text','image',
    'type','news_Time',
    'tv_id','views','state'];


    public function news_comments(){
        return $this->hasMany(Comments::class,'news_id','id');
    }

    



}
