<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\TV;
use Illuminate\Http\Request;

class CastController extends Controller
{





    public function show(){

        $casts = Cast::with('comic')->get();
        $allcartoons = TV::all();

        return View('layouts.casts.casts',compact('casts','allcartoons'));

    }

    public function addCast(Request $request){



        $post['title'] = $request->title;
        $post['poster'] = $request->poster;
        $post['comic_id'] = $request->comic_id;
        $post['typeiscomicornot'] = $request->typeiscomicornot;
        $post['statu'] = $request->status;



        $comentof = Cast::create($post);
        if (!$comentof) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }

 public function deletcasts($id){

        $casts = Cast::find($id);
        $casts->delete();

    }


    public function editcastsview($id){

        $cast = Cast::find($id);
        $allcartoons = TV::all();

        return View('layouts.casts.editcasts',compact('cast','allcartoons'));

    }

    public function editcasts($id,Request $request){

        $cast = Cast::find($id);


        $cast['title'] = $request->title;
        $cast['poster'] = $request->poster;
        $cast['comic_id'] = $request->comic_id;
        $cast['typeiscomicornot'] = $request->typeiscomicornot;
        $cast['statu'] = $request->status;



        $cast->save();

        if (!$cast) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }
}
