<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skipgooglemodel extends Model
{
    use HasFactory;


    protected $table = "skipgoogle";


    protected $fillable = ['isgo','text','version'];

}
