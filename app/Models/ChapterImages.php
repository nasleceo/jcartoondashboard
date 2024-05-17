<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterImages extends Model
{
    use HasFactory;


    public $table = "chaptersimages";

    protected $fillable = [
        'title','chapter_id','comic_id',
        'direct_link'];

        public function chapter(){
            return $this->hasOne(chapters::class,'id','chapter_id');
        }


}
