<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class updateapp extends Model
{
    use HasFactory;


    public $table = "updateapp";

    protected $fillable = [
    'Latest_APK_Version_Name','Latest_APK_Version_Code',
    'APK_File_URL','Whats_new_on_latest_APK','Update_Skipable',
    'Update_Type','googleplayAppUpdateType','Contact_Email'];


    



}
