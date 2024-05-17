<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;

    protected $table = "video";

    protected $fillable = ['lebel','tv_id','epe_id','quality','size',
    'url','processed_file','processed','processing_percentage'];


    public function epeisod(){
        return $this->hasone(episodemodel::class,'id','epe_id');
    }



}
