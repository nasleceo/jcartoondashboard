<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Cast extends Model
{
    use HasFactory;
    use Favoriteable;



    public $table = "casts";

    protected $fillable = [
        'title','poster','comic_id',
        'typeiscomicornot','statu'];

        public function comic(){
            return $this->hasone(TV::class,'id','comic_id');
        }
}
