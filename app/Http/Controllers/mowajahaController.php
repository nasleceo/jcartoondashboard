<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Posts;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class mowajahaController extends Controller
{


    public function show()
    {
        $posts = Posts::withTotalVisitCount()->with('poste_user')->with('poste_cast')->with('poste_cast_tani')
        ->with('poste_comments')->where('type','mawajaha')->get();
        $allcartoons = Cast::all();

        return View('layouts.mowajaha.mowajaha', compact('posts','allcartoons'));
    }


    public function addmowajaha(Request $request){

        if($request->cast_id == $request->cast_id_2){
            return Response()->json('exit');
        }


        $checkifthereis = Posts::where('state','Published')->where('type','mawajaha')->where([
            'cast_id' => $request->cast_id,
            'cast_id_2' => $request->cast_id_2
     ])->orWhere([
        'cast_id' => $request->cast_id_2,
        'cast_id_2' => $request->cast_id
 ])->first();

              if ($checkifthereis) {
                if ($checkifthereis->cast_id == $request->cast_id || $checkifthereis->cast_id_2 == $request->cast_id_2 ) {

                    return Response()->json('exit');
                }
                return Response()->json('exit');
              }


        $data['user_id'] = 1;
        $data['poster'] = null;
        $data['text'] = $request->text;
        $data['type'] = 'mawajaha';
        $data['post_Time'] = now()->toDateString();;
        $data['ishark'] =  0;
        $data['activecomments'] = 0;
        $data['tv_id'] = null;
        $data['tawsiat_tv_id'] = null;
        $data['cast_id'] = $request->cast_id;
        $data['cast_id_2'] = $request->cast_id_2;
        $data['views'] = 0;
        $data['state'] = $request->status;



        $movie = Posts::create($data);
        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }


    public function deletmowaajaha($id){

        $casts = Posts::find($id);
        $casts->delete();

    }

}
