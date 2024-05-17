<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    use HasFactory;



    public $table = "reports";

    protected $fillable = [
    'movie_id','type','text','movieortv'];



    public function comics(){

      return $this->hasOne(TV::class,'id','movie_id');

    }


}
