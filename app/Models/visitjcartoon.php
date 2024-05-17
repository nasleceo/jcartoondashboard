<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitjcartoon extends Model
{
    use HasFactory;

    public $table = "visitjcartoons";


    protected $fillable = [
    'cartoon_id','number_visit','type','post_id'];


    public function cartoon()
    {
        return $this->hasMany(TV::class, 'id', 'cartoon_id');
    }



}
