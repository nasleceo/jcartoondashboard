<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\replay;
use Illuminate\Http\Request;

class ReplayController extends Controller
{




    public function showcommentsofpost($id){


        $comments = replay::with('user')->get();

        $commanetold = Comments::find($id);

        return View('layouts.comments.replays',compact('comments','commanetold'));

    }



    public function addreplay($id,Request $request){



        $post['user_id'] = 1;
        $post['content'] = $request->content;
        $post['comment_id'] = $id;
        $post['statu'] = $request->status;
        $post['type'] = 'replay';



        $comentof = replay::create($post);
        if (!$comentof) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';



    }
    public function deletreplay($id){
        $comentof = replay::find($id);

        $comentof->delete();

    }



}
