<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mowajahaModel extends Model
{
    use HasFactory;


    public $table = "mowajahalike";

    protected $fillable = [
        'user_id','post_id','cast1',
        'cast2'];





}
