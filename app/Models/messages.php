<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;

    public $table = "messages";

    protected $fillable = [
    'body','read','user_id','conversation_id'];



    public function room(){
        return $this->hasOne(RoomModel::class,'id','conversation_id');
    }

    public function message_user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
