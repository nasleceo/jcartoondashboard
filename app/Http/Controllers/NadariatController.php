<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class NadariatController extends Controller
{



    public function show()
    {
        $posts = Posts::withTotalVisitCount()->with('poste_user')->with('poste_comments')->with('poste_cartoon')->where('type','nadariat')->get();



       $posts_unaproved = Posts::where('type','nadariat')->where('state','Unpublished')->get();
        return View('layouts.nadariat.nadariat', compact('posts','posts_unaproved'));
    }


    public function addpost(Request $request){


        $data['user_id'] = 1;
        $data['poster'] = null;
        $data['text'] = $request->text;
        $data['type'] = 'nadariat';
        $data['post_Time'] = now()->toDateString();;
        $data['ishark'] =  0;
        $data['activecomments'] = 0;
        $data['tv_id'] = $request->tv_id;
        $data['cast_id'] = null;
        $data['cast_id_2'] = null;
        $data['views'] = 0;
        $data['state'] = $request->status;



        $movie = Posts::create($data);
        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }


    public function acceptnadar($id){



        $post = Posts::find($id);


        $post['state'] = 'Published';



         $post->save();
         if (!$post) {
             return 'خطا في إدخال المعلومات';
         }

        return redirect()->route('nadariat');



     }


     public function deletnadaria($id){

        $post = Posts::find($id);

        $post->delete();

    }





    public function editpostview($id){

        $nadaria = Posts::find($id);

        return View('layouts.nadariat.editnadariat',compact('nadaria'));

    }


    public function editpost($id,Request $request){


       $post = Posts::find($id);



        $post['tv_id'] = $request->tv_id;
        $post['text'] = $request->text;
        $post['state'] = $request->status;



        $post->save();
        if (!$post) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }




}
