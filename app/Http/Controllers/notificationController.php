<?php

namespace App\Http\Controllers;

use App\Models\TV;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class notificationController extends Controller
{


    public function show(){

        $allcartoons = TV::all();

        return View('layouts.notifi.notifi',compact('allcartoons'));

    }

    public function getcartoonfronotificatiob($id){


        $allcartoons = TV::findOrFail($id);

        return Response()->json($allcartoons);



    }


}
