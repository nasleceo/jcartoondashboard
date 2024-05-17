<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\TV;
use Illuminate\Http\Request;

class RateController extends Controller
{



    public function show()
    {

        $rates = Rate::with('cartoon')->with('user')->get();
        $allcartoons = TV::all();


        return View('layouts.rates.rates', compact('rates','allcartoons'));


    }

    public function addrates(Request $request){


        $data['user_id'] = 1;
        $data['jcartoonrate'] = $request->jcartoonrate;
        $data['tv_id'] = $request->tv_id;



        $movie = Rate::create($data);
        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }

    public function deletrate($id){

        $casts = Rate::find($id);
        $casts->delete();

    }


}
