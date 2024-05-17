<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    use HasFactory;


    public $table = "room";


    protected $fillable = [
    'title','who_create_room_user_id','invitaion_code','conversation_id','time_creted','tv_id','season_id','epe_id','type_ispublic_private','number_limit'];


    public function room_user_create(){
        return $this->hasOne(User::class,'id','who_create_room_user_id');
    }

    public function cartoon(){
        return $this->hasOne(TV::class,'id','tv_id');
    }

    public function room_messages(){
        return $this->hasMany(messages::class,'conversation_id','id');
    }

    public function room_users(){
        return $this->hasMany(RoomUsersModel::class,'room_id','id');
    }

    public function room_epe(){
        return $this->hasOne(episodemodel::class,'id','epe_id');
    }

}
