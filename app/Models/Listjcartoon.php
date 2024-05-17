<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listjcartoon extends Model
{
    use HasFactory;



    public $table = "listjcartoons";

    protected $fillable = [
    'user_id','type',
    'tv_id'];



    public function episodes(){
        return $this->hasOne(TV::class,'id','tv_id');
    }




}
