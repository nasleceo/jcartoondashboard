<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUsersModel extends Model
{
    use HasFactory;


    public $table = "roomUsers";


    protected $fillable = [
    'user_id','room_id','invitaion_code'];



    public function room(){
        return $this->hasOne(RoomModel::class,'id','room_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }



}
