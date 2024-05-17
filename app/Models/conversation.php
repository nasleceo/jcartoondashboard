<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;


    public $table = "conversations";

    protected $fillable = [
    'title'];


    public function messages(){
        return $this->hasMany(messages::class,'conversation_id','id');
    }

    

}
