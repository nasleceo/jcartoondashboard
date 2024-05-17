<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;



    public $table = "notifications";

    protected $fillable = [
    'user_id','sender_user_id',
    'text','type','post_Time','place',
    'cartoon_id','post_id','comment_id','replay_id'];


    // type = like or comment or all

    public function notification_user(){
        return $this->hasOne(User::class,'id','sender_user_id');
    }

    public function notification_cartoon(){
        return $this->hasOne(TV::class,'id','sender_user_id');
    }

    public function notification_post(){
        return $this->hasOne(Posts::class,'id','sender_user_id');
    }

    

}
