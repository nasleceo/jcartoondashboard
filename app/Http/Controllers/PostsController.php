<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\TV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

use function PHPUnit\Framework\isEmpty;

class PostsController extends Controller
{


    public function show()
    {
        $posts = Posts::withTotalVisitCount()->with('poste_user')->with('poste_comments')->where('type','post')->get();



       $posts_unaproved = Posts::where('state','Unpublished')->where('type','post')->get();
        return View('layouts.posts.posts', compact('posts','posts_unaproved'));
    }

    public function addpostview(){
        return View('layouts.posts.addpost');

    }

    public function addpost(Request $request){


        $data['user_id'] = 1;
        $data['poster'] = $request->poster;
        $data['text'] = $request->text;
        $data['type'] = 'post';
        $data['post_Time'] = now()->toDateString();
        $data['ishark'] =  0;
        $data['activecomments'] = 0;
        $data['tv_id'] = null;
        $data['tawsiat_tv_id'] = null;
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

    public function editpostview($id){

        $post = Posts::find($id);

        return View('layouts.posts.editpost',compact('post'));

    }


    public function editpost($id,Request $request){


       $post = Posts::find($id);



        $post['poster'] = $request->poster;

        $post['text'] = $request->text;
        $post['state'] = $request->status;



        $post->save();
        if (!$post) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }


    public function acceptpost($id){


        $post = Posts::find($id);


        $post['state'] = 'Published';



         $post->save();
         if (!$post) {
             return 'خطا في إدخال المعلومات';
         }

         return redirect()->route('posts');



     }




    public function deletpost($id){

        $post = Posts::find($id);

        $post->delete();

    }


    public function showcommentsofpost($id){

        $post = Posts::find($id);


        $comments = Comments::with('poste')->where('post_id',$id)->get();


        return View('layouts.posts.postcommments',compact('comments','post'));

    }


    public function addcommentsofpost($id,Request $request){



         $post['user_id'] = 1;
         $post['content'] = $request->content;
         $post['tv_id'] = null;
         $post['post_id'] = $id;
         $post['news_id'] = null;
         $post['ishark'] = 0;
         $post['statu'] = $request->status;
         $post['type'] = 'postcomments';



         $comentof = Comments::create($post);
         if (!$comentof) {
             return 'خطا في إدخال المعلومات';
         }

         return 'تم الأمر بنجاح';



     }


     public function deletcommentsofpost($id){

        $post = Comments::find($id);

        $post->delete();
     }


     public function editshowcommentsofpost($id){


        $comments = Comments::with('poste')->find($id);


        return View('layouts.posts.editpostcommments',compact('comments'));

    }

    public function editcommentsofpost($id,Request $request){

        $comentof = Comments::find($id);

        $comentof['content'] = $request->content;
        $comentof['statu'] = $request->status;



        $comentof->save();

        if (!$comentof) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }

    public function showtawsiat()
    {
        $posts = Posts::withTotalVisitCount()->with('poste_user')->with('poste_comments')->with('poste_cartoon')
        ->with('poste_cartoon_mosabih')->where('type','tawsia')->get();
        $allcartoons = TV::all();

       $posts_unaproved = Posts::where('state','Unpublished')->where('type','tawsia')->get();


        return View('layouts.tawsiat.tawsiat', compact('posts','posts_unaproved','allcartoons'));
    }

    public function addtawsiat(Request $request){


        $data['user_id'] = 1;
        $data['poster'] = null;
        $data['text'] = $request->text;
        $data['type'] = 'tawsia';
        $data['post_Time'] = now()->toDateString();;
        $data['ishark'] =  0;
        $data['activecomments'] = 0;
        $data['tv_id'] = $request->tv_id;
        $data['tawsiat_tv_id'] = $request->tawsiat_tv_id;
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
}
