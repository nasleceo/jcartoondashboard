<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class server extends Model
{
    use HasFactory;


    protected $table = "servers";

    protected $fillable = ['lebel','epe_id',
    'source','url','type'];

    public function epe(){
        return $this->hasOne(episodemodel::class,'id','epe_id');
    }



}
