<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonModel extends Model
{
    use HasFactory;



    protected $table = "seasons";


    protected $fillable = ['name','movie_id','Episodes','status'];


    public function episodes(){
        return $this->hasMany(episodemodel::class,'season_id','id');
    }

}
