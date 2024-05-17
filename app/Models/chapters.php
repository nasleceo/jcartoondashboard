<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chapters extends Model
{
    use HasFactory;


    public $table = "chapters";

    protected $fillable = [
        'title','type','comic_id',
        'direct_link','chapters_folder_link','statu'];


        public function comic(){
            return $this->hasOne(TV::class,'id','comic_id');
        }

        public function images(){
            return $this->hasMany(ChapterImages::class,'chapter_id','id');
        }

}
