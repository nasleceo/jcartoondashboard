<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{


    public function showcommentsofpost(){


        $comments = Comments::with('poste')->with('news')->with('news')->with('replay')->get();


        return View('layouts.comments.comments',compact('comments'));

    }





    public function addcomments(Request $request){



        $post['user_id'] = 1;
        $post['content'] = $request->content;
        $post['tv_id'] = 14;
        $post['post_id'] = 2;
        $post['news_id'] = 1;
        $post['ishark'] = 0;
        $post['statu'] = $request->status;
        $post['type'] = 'allcomments';



        $comentof = Comments::create($post);
        if (!$comentof) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }
    public function deletcomment($id){
        $comentof = Comments::find($id);

        $comentof->delete();

    }

}
