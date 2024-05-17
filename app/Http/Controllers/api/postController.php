<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\mowajahaModel;
use App\Models\NotificationModel;
use App\Models\Posts;
use App\Models\ReportModel;
use App\Models\User;
use App\Models\visitjcartoon;
use Illuminate\Http\Request;

class postController extends Controller
{



    public function posts()
    {

        $posts = Posts::withCount('Views')->withCount('likers')->withCount('favoriters')->with('poste_user')->with('poste_cartoon')
        ->with('poste_cast')->with('poste_cast_tani')->orderByDesc('id')->paginate(15);

        return response()->json($posts);
    }

    public function mostliked()
    {

        $posts = Posts::withCount('Views')->withCount('likers')->withCount('favoriters')->with('poste_user')->with('poste_cartoon')
        ->with('poste_cast')->with('poste_cast_tani')->orderByDesc('likers_count')->paginate(10);

        return response()->json($posts);
    }

    public function trendpost($country)
    {

        $posts = Posts::withCount('Views')->withCount('likers')->withCount('favoriters')->with('poste_user')->with('poste_cartoon')
        ->with('poste_cast')->with('poste_cast_tani')->where('country', $country)->orderByDesc('views_count')->paginate(10);

        return response()->json($posts);
    }


    public function random()
    {

        $posts = Posts::withCount('Views')->withCount('likers')->withCount('favoriters')->with('poste_user')->with('poste_cartoon')
        ->with('poste_cast')->with('poste_cast_tani')->inRandomOrder()->paginate(10);

        return response()->json($posts);
    }



    public function visitpost($id)
    {

        $posts = Posts::with('poste_user')->with('poste_comments')->with('poste_cartoon')->with('poste_cast')
            ->with('poste_cast_tani')->findOrFail($id);

        $visitis['post_id'] = $posts->id;
        $visitis['number_visit'] = 1;
        $visitis['type'] = 'post';

        visitjcartoon::create($visitis);

        $visit_count = count(visitjcartoon::where(['post_id' => $posts->id, 'type' => 'post'])->get());









        return response()->json([
            'post' => $posts,
            'visit_count' => $visit_count
        ]);
    }

    public function addviewtopost($id)
    {

        $visitis['post_id'] = $id;
        $visitis['number_visit'] = 1;
        $visitis['type'] = 'post';

        visitjcartoon::create($visitis);


        return response()->json(['message' => 'added']);
    }



    public function addpost(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Customize the storage path and file name as needed
            $path = 'postimages/' . date("d-m-Y") . '-' . time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $path);
            $data['poster'] = $path;
            // Do additional processing or save the file path to the database if needed
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully']);
        }

        // if ($request->poster != null) {

        //     $path = public_path('postimages/') . date("d-m-Y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';
        //     if (file_put_contents($path, base64_decode($request->poster))) {

        //         $data['poster'] = $path;
        //     } else {
        //         $data['poster'] = null;
        //     }
        // } else {
        //     $data['poster'] = null;
        // }


        $data['user_id'] = $request->user_id;
        $data['text'] = $request->text;
        $data['type'] = $request->type;
        $data['post_Time'] = $request->post_Time;
        $data['ishark'] =  $request->ishark;
        $data['country'] =  $request->country;
        $data['activecomments'] = $request->activecomments;
        $data['tv_id'] = $request->tv_id;
        $data['tawsiat_tv_id'] = $request->tawsiat_tv_id;
        $data['cast_id'] = $request->cast_id;
        $data['cast_id_2'] = $request->cast_id_2;
        $data['state'] = $request->status;



        $addedpost = Posts::create($data);

        if ($addedpost) {



            return response()->json(['message' => 'added']);
        } else {

            return response()->json(['message' => 'error']);
        }
    }


    public function Likeposts(Request $request)
    {



        $comentof = Posts::find($request->post_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if (!$checklike) {
            $user->like($comentof);


            if($request->user_id != $request->target_user_id){
                $data['user_id'] = $comentof->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'أعجب بمنشورك';
                $data['type'] = 'like';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['post_id'] = $request->post_id;


                NotificationModel::create($data);
            }



            return response()->json(['message' => 'like']);
        } else {
            $user->unlike($comentof);
            return response()->json(['message' => 'unlike']);
        }
    }

    public function Likepostsnadariat(Request $request)
    {



        $comentof = Posts::find($request->post_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if (!$checklike) {
            $user->like($comentof);

            if($request->user_id != $comentof->user_id){
                $data['user_id'] = $comentof->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'أعجب بمنشورك';
                $data['type'] = 'like';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['post_id'] = $request->post_id;


                NotificationModel::create($data);
            }



            return response()->json(['message' => 'like']);
        } else {
            $user->unlike($comentof);
            return response()->json(['message' => 'unlike']);
        }
    }

    public function Savepost(Request $request)
    {



        $comentof = Posts::find($request->post_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasFavorited($comentof);

        if (!$checklike) {
            $user->favorite($comentof);
            if($request->user_id != $comentof->user_id){
                $data['user_id'] = $comentof->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'قام بحفظ منشورك';
                $data['type'] = 'save';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['post_id'] = $request->post_id;


                NotificationModel::create($data);
            }



            return response()->json(['message' => 'favorite']);
        } else {
            $user->unfavorite($comentof);
            return response()->json(['message' => 'unfavorite']);
        }
    }

    public function CheckLikeposts(Request $request)
    {



        $comentof = Posts::find($request->post_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if (!$checklike) {
            return response()->json(['message' => 'like']);
        } else {
            return response()->json(['message' => 'unlike']);
        }
    }

    public function reportpost(Request $request)
    {



        $data['movie_id'] = null;
        $data['type'] = $request->type;
        $data['text'] = $request->text;
        $data['movieortv'] = null;
        $data['post_id'] = $request->post_id;


        $addedpost = ReportModel::create($data);


        if ($addedpost) {

            return response()->json(['message' => 'report']);
        } else {

            return response()->json(['message' => 'error']);
        }
    }


    public function Followunfollowuser(Request $request)
    {



        $user_ana = User::find($request->user_id);
        $target_user = User::find($request->target_user_id);



        $checklike = $user_ana->isFollowing($target_user);


        if (!$checklike) {
            $user_ana->follow($target_user);

            if($request->user_id != $request->target_user_id){
                $data['user_id'] = $request->target_user_id;
                $data['sender_user_id'] = $request->$user_ana;
                $data['text'] = 'قام بمتابعتك';
                $data['type'] = 'follow';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['post_id'] = $request->post_id;


                NotificationModel::create($data);
            }


            return response()->json(['message' => 'follow']);
        } else {
            $user_ana->unfollow($target_user);
            return response()->json(['message' => 'unfollow']);
        }
    }

    public function CheckFollow(Request $request)
    {



        $user_ana = User::find($request->user_id);
        $target_user = User::find($request->target_user_id);




        $checklike = $user_ana->isFollowing($target_user);

        if (!$checklike) {
            return response()->json(['message' => 'follow']);
        } else {
            return response()->json(['message' => 'unfollow']);
        }
    }

    public function getfollowings($user_id)
    {


        $user_ana = User::find($user_id);
        $data = $user_ana->followings()->paginate(10);


        return response()->json($data);
    }

    public function getfollowers($user_id)
    {


        $user_ana = User::find($user_id);
        $data = $user_ana->followers()->paginate(10);


        return response()->json($data);
    }


    public function notifications($id)
    {

        $posts = NotificationModel::with('notification_user')->with('notification_cartoon')->with('notification_post')->where('user_id',$id)->orderByDesc('id')->paginate(20);

        return response()->json($posts);
    }

}
