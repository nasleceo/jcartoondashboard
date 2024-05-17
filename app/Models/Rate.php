<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;



    public $table = "rate";

    protected $fillable = [
    'user_id','jcartoonrate',
    'tv_id'];


    public function cartoon(){
        return $this->hasOne(TV::class,'id','tv_id');
    }


    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    

}
