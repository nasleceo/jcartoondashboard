<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;


class replay extends Model
{
    use HasFactory;
     use Likeable;



    public $table = "replays";


    protected $fillable = [
        'user_id','content','comment_id',
        'statu','type'];

        public function comment(){
            return $this->hasOne(Comments::class,'id','comment_id');
        }

        public function user(){
            return $this->hasOne(User::class,'id','user_id');
        }




}
