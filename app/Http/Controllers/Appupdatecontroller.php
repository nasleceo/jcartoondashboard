<?php

namespace App\Http\Controllers;

use App\Models\updateapp;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class Appupdatecontroller extends Controller
{



    public function appupdateShow(){

        $update = updateapp::first();

        return View('layouts.appsetting.updateapp',compact('update'));

    }

    public function appupdateShowapi(){

        $update = updateapp::first();

        return Response()->json($update);

    }

    public function urlandapiShow(){


        return View('layouts.appsetting.urlandapi');

    }




    public function saveupdate(Request $request){

        $update = updateapp::first();



        $update['Latest_APK_Version_Name'] = $request->apk_version_name;
        $update['Latest_APK_Version_Code'] = $request->apk_version_code;
        $update['APK_File_URL'] = $request->latest_apk_url;
        $update['Whats_new_on_latest_APK'] = $request->apk_whats_new;
        if ($request->update_skipable == 'on') {
            $update['Update_Skipable'] = 1 ;

        }else {
            $update['Update_Skipable'] = 0 ;

        }
        $update['Update_Type'] = $request->Update_Type;
        $update['googleplayAppUpdateType'] = $request->GooglePlay_Update_Type;
        $update['Contact_Email'] = 'jcartoon2023@gmail.com';

        $update->save();

    }

}
