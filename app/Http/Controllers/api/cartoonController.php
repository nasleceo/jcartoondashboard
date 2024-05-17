<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllTVCollection;
use App\Http\Resources\TVCollection;
use App\Models\allvideos;
use App\Models\Cast;
use App\Models\ChapterImages;
use App\Models\chapters;
use App\Models\Comments;
use App\Models\episodemodel;
use App\Models\Listjcartoon;
use App\Models\mowajahaModel;
use App\Models\News;
use App\Models\NotificationModel;
use App\Models\Posts;
use App\Models\Rate;
use App\Models\replay;
use App\Models\RoomModel;
use App\Models\SeasonModel;
use App\Models\server;
use App\Models\TV;
use App\Models\User;
use App\Models\visitjcartoon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class cartoonController extends Controller
{



    public function tvs()
    {

        $tv = TV::where('place', 'Published,tv')->paginate(10);

        return response()->json( $tv);
    }

    public function movies()
    {

        $tv = TV::where('place', 'Published,movie')->paginate(10);

        return response()->json( $tv);
    }

    public function comics()
    {

        $tv = TV::where('place', 'Published,comic')->paginate(10);

        return response()->json( $tv);
    }


    public function oneTvorCartoonorComic($id)
    {

        $tv = TV::findOrFail($id);


        $rooms = RoomModel::where('tv_id', $id)->get();
        $news = News::where('tv_id', $id)->get();
        $seasoncount = SeasonModel::where('movie_id', $id)->count();
        $Cast = Cast::where('comic_id', $id)->get();
        $rates = Rate::where('tv_id', $id)->get();
        $review = Posts::with('poste_user')->with('poste_cartoon')->where('type', 'review')->where('tv_id', $id)->get();
        $nadariat = Posts::where('type', 'nadariat')->where('tv_id', $id)->get();
        $tawsia = Posts::with('poste_cartoon')->where('type', 'tawsia')->where('tv_id', $id)->get();
        // $iktirahat = TV::where('place','not like', '%' . 'comic' . '%')->where('gener','LIKE', '%' . $tv->gener . '%')
        // ->where('id','!=',$id )->take(10)->get();


        $ratt =  number_format((float)$rates->avg('jcartoonrate'), 2, '.', '');


        if (str_contains($tv->place, 'tv')) {
            $type = 'tv';
            $iktirahat = TV::where('place', 'Published,tv')->inRandomOrder()->limit(10)->get();
        } else if (str_contains($tv->place, 'movie')) {
            $type = 'movie';
            $iktirahat = TV::where('place', 'Published,movie')->inRandomOrder()->limit(10)->get();
        } else {
            $type = 'comic';
            $iktirahat = TV::where('place', 'Published,comic')->inRandomOrder()->limit(10)->get();
        }


        $visitis['cartoon_id'] = $tv->id;
        $visitis['number_visit'] = 1;
        $visitis['type'] = 'cartoon';

        visitjcartoon::create($visitis);


        $visit_count = count(visitjcartoon::where(['cartoon_id' => $tv->id, 'type' => 'cartoon'])->get());

        return response()->json([
            'tv' => $tv,
            'visit_count' => $visit_count,
            'rooms' => $rooms,
            'type' => $type,
            'news' => $news,
            'seasoncount' => $seasoncount,
            'Cast' => $Cast,
            'rate' => $ratt,
            'review' => $review,
            //'tawsia' => ,
            'iktirahat' => $iktirahat,
            'ads_img' => null,
            'ads_link' => null
        ]);
    }



    public function addRate(Request $request)
    {


        $valid = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'jcartoonrate' => 'required',
            'tv_id' => 'required'
            // 'userspecial_name' => 'required|string|unique:users,userspecial_name',
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'شيئ ناقص',
            ], 201);
        }


         $isexist = Rate::where(['user_id' => $request->user_id, 'tv_id' => $request->tv_id])->first();

        if ($isexist) {

            $fav = Rate::findOrFail($isexist->id);
            $fav->delete();

        }

        $rate['user_id'] = $request->user_id;
        $rate['jcartoonrate'] = $request->jcartoonrate;
        $rate['tv_id'] = $request->tv_id;


        Rate::create($rate);

        return response()->json(['message' => 'added']);
    }

    public function addFavorite(Request $request)
    {


        $valid = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'type' => 'required',
            'tv_id' => 'required'
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'error',
            ], 404);
        }


        $isexist = Listjcartoon::where(['user_id' => $request->user_id, 'type' => $request->type,'tv_id' => $request->tv_id])->first();

        if ($isexist) {

            $fav = Listjcartoon::findOrFail($isexist->id);
            $fav->delete();

            return response()->json([
                'message' => 'exist',
            ], 201);
        }


        $rate['user_id'] = $request->user_id;
        $rate['type'] = $request->type;
        $rate['tv_id'] = $request->tv_id;


        Listjcartoon::create($rate);

        return response()->json(['message' => 'added']);
    }
    public function checkFavorite(Request $request)
    {


        $valid = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'tv_id' => 'required'
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'شيئ ناقص',
            ], 201);
        }


        $isexist = Listjcartoon::where(['user_id' => $request->user_id, 'tv_id' => $request->tv_id])->first();

        if ($isexist) {

            return response()->json([
                'message' => 'exist',
            ], 201);
        } else {

            return response()->json(['message' => 'no_exist']);
        }
    }


    public function getSeasonsoftv($id)
    {

        $seasons = SeasonModel::where('movie_id', $id)->get();

        return response()->json(['data' => $seasons]);
    }

    public function getEpisodes($id)
    {

        $episodes = episodemodel::with('video_cartoon')->where(['season_id' =>  $id])->get();

        return response()->json($episodes);
    }

    public function OneEpisode($id)
    {

        $episodes = episodemodel::with('video_quality')->findOrFail($id);

        return response()->json($episodes);
    }

    public function getLastEpisodes()
    {

        $episodes = episodemodel::with('video_cartoon')->latest()->limit(20)->get();

        return response()->json(['data' => $episodes]);
    }


    public function getServers($id)
    {

        $episodes = server::where('epe_id', $id)->get();

        return response()->json(['data' => $episodes]);
    }


    public function getMovieVideos($id)
    {

        $video = episodemodel::where('tv_id', $id)->get();

        return response()->json($video);
    }

    public function OneVideo($id)
    {

        $episodes = allvideos::with('video_quality')->findOrFail($id);

        return response()->json($episodes);
    }

    public function getChapters($id)
    {

        $video = chapters::where('comic_id', $id)->get();

        return response()->json(['data' => $video]);
    }

    public function getchapterPages($id)
    {

        $video = ChapterImages::where('chapter_id', $id)->get();

        return response()->json(['data' => $video]);
    }

    public function getLastChapters()
    {

        $episodes = chapters::with('comic')->latest()->limit(20)->get();

        return response()->json(['data' => $episodes]);
    }

    public function Toptvs()
    {

        $tv = TV::withCount('Views')->where('place', 'Published,tv')->orderByDesc('views_count')->limit(20)->get();

        return new AllTVCollection($tv);
    }

    public function TopMovies()
    {

        $tv = TV::withCount('Views')->where('place', 'Published,movie')->orderByDesc('views_count')->limit(20)->get();

        return new AllTVCollection($tv);
    }

    public function TopComics()
    {

        $tv = TV::withCount('Views')->where('place', 'Published,comic')->orderByDesc('views_count')->limit(20)->paginate(20);

       return response()->json( $tv);
    }

    public function mosttvandmovieaddedtofavourit()
    {

        $tv = TV::withCount('favourites')->where('place', '!=', 'Published,comic')->orderByDesc('favourites_count')->limit(20)->paginate(20);

        return response()->json( $tv);
    }

    public function newrelease()
    {

        $tv = TV::orderByDesc('id')->where('place', 'Published,tv')->limit(12)->paginate(12);

         return response()->json( $tv);
    }

    public function pinedcartoons()
    {

        $tv = TV::where('pin', 1)->inRandomOrder()->limit(20)->paginate(20);

        return response()->json( $tv);
    }

    public function slider()
    {

        $tv = TV::where('place', 'LIKE', '%' . 'Published' . '%')->inRandomOrder()->first();

        return response()->json($tv);
    }

    public function SearchFilter(Request $request)
    {


        $tv = TV::query();



        if($request->filled('title')){
            $tv->orWhere('title', 'like', '%' . request('title') . '%');
        }

        if($request->filled('place')){
            $tv->orWhere('place', 'like', '%' . request('place') . '%');
        }

        if($request->filled('gener')){
            $tv->orWhere('gener', 'like', '%' . request('gener') . '%');
        }

        if($request->filled('year')){
            $tv->orWhere('year',$request->year);
        }


        return response()->json(["data" => $tv->where('place', "LIKE","%".'Published'."%")->get()]);


    }


    /*----------------------------  التعليقات و الردود ---------------------------- */


    public function commentsofcartoon($id)
    {

        $comments = Comments::where('tv_id', $id)->withCount('likers')->withCount('replay')->with('user')->orderByDesc('id')->paginate(30);

        return response()->json($comments);
    }

    public function replaysofcomments($id)
    {

        $replays = replay::where('comment_id',$id)->withCount('likers')->with('user')->orderByDesc('id')->paginate(50);


        return response()->json($replays);
    }


    public function addCommentCartoon(Request $request)
    {


        $valid = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'content' => 'required',
            'tv_id' => 'required'
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'error',
            ], 404);
        }

        $post['user_id'] = $request->user_id;
        $post['content'] = $request->content;
        $post['tv_id'] = $request->tv_id;
        $post['post_id'] = null;
        $post['news_id'] = null;
        $post['ishark'] = $request->ishark;
        $post['statu'] = $request->status;
        $post['type'] = 'cartoon';



        $addded = Comments::create($post);




        return response()->json(['message' => 'added']);
    }

    public function deletcomment($id){

        $comentof = Comments::find($id);

        $comentof->delete();

        return response()->json(['message' => 'deleted']);

    }

    public function commentsofpost($id)
    {

        $comments = Comments::where('post_id', $id)->withCount('likers')->withCount('replay')->with('user')->orderByDesc('id')->paginate(30);

        return response()->json($comments);
    }

    public function addcommentpost(Request $request)
    {



        $post['user_id'] = $request->user_id;
        $post['content'] = $request->content;
        $post['tv_id'] = null;
        $post['post_id'] = $request->post_id;
        $post['news_id'] = null;
        $post['ishark'] = $request->ishark;
        $post['statu'] = $request->status;
        $post['type'] = 'post';


        $posts = Posts::find($request->post_id);

        $addded = Comments::create($post);

        if($addded){
            if($request->user_id != $posts->user_id){


                $data['user_id'] = $posts->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'قام بتعليق علي منشورك';
                $data['type'] = 'comment';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['comment_id'] = $request->post_id;


                NotificationModel::create($data);
            }

         return response()->json(['message' => 'added']);

        }


        return response()->json(['message' => 'added']);
    }

    public function commentsofnews($id)
    {

        $comments = Comments::where('news_id', $id)->get();

        return response()->json(['data' => $comments]);
    }

    public function addcommentnews(Request $request)
    {


        $valid = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'content' => 'required',
            'post_id' => 'required'
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'error',
            ], 404);
        }

        $post['user_id'] = $request->user_id;
        $post['content'] = $request->content;
        $post['tv_id'] = null;
        $post['post_id'] = null;
        $post['news_id'] = $request->news_id;
        $post['ishark'] = $request->ishark;
        $post['statu'] = $request->status;
        $post['type'] = 'news';



        Comments::create($post);


        return response()->json(['message' => 'added']);
    }

    public function addReplay(Request $request)
    {


        $comment = Comments::find($request->comment_id);

        $post['user_id'] = $request->user_id;
        $post['content'] = $request->content;
        $post['comment_id'] = $request->comment_id;
        $post['statu'] = $request->statu;

        $addded = replay::create($post);



        if($addded){
            if($request->user_id != $comment->user_id){


                $data['user_id'] = $comment->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'قام بالرد علي تعليقك';
                $data['type'] = 'replay';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['replay_id'] = $request->comment_id;


                NotificationModel::create($data);

            }

        }

        return response()->json(['message' => 'added']);
    }

    public function deletReplay($id){

        $comentof = replay::find($id);

        $comentof->delete();

        return response()->json(['message' => 'deleted']);

    }

    /*---------------------------- الإعجابات ---------------------------- */

    public function LikeComment(Request $request){



        $comentof = Comments::find($request->comment_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if(!$checklike){
            $user->like($comentof);
            if($request->user_id != $comentof->user_id){


                $data['user_id'] = $comentof->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'أعجب بتعليقك';
                $data['type'] = 'likecomment';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['post_id'] = $comentof->post_id;


                NotificationModel::create($data);
            }



            return response()->json(['message' => 'like']);

        }else{
            $user->unlike($comentof);
            return response()->json(['message' => 'unlike']);

        }



    }

    public function CheckLikeComment(Request $request){



        $valid = Validator::make($request->all(), [
            'user_id' => 'required',
            'comment_id' => 'required'
             ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'error',
            ], 404);
        }



        $comentof = Comments::find($request->comment_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if(!$checklike){
            return response()->json(['message' => 'like']);

        }else{
            return response()->json(['message' => 'unlike']);

        }



    }

    public function likeunlikereplay(Request $request){



        $comentof = replay::find($request->comment_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if(!$checklike){
            $user->like($comentof);

            if($request->user_id != $comentof->user_id){
                $data['user_id'] = $comentof->user_id;
                $data['sender_user_id'] = $request->user_id;
                $data['text'] = 'أعجب بتعليقك';
                $data['type'] = 'likecomment';
                $data['post_Time'] = now()->getTimestampMs();
                $data['place'] = 'user';
                $data['post_id'] = $comentof->post_id;


                NotificationModel::create($data);
            }


            return response()->json(['message' => 'like']);

        }else{
            $user->unlike($comentof);
            return response()->json(['message' => 'unlike']);

        }



    }

    public function CheckLikereplay(Request $request){



        $valid = Validator::make($request->all(), [
            'user_id' => 'required',
            'comment_id' => 'required'
             ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'error',
            ], 404);
        }



        $comentof = replay::find($request->comment_id);
        $user = User::find($request->user_id);



        $checklike = $user->hasLiked($comentof);

        if(!$checklike){
            return response()->json(['message' => 'like']);

        }else{
            return response()->json(['message' => 'unlike']);

        }



    }

    public function allnews()
    {

        $tv = News::paginate(10);

        return response()->json( $tv);
    }

    public function Likemowajaha(Request $request)
    {
        $post = Posts::find($request->post_id);

        if($request->cast1 != null){

            $cast1db = mowajahaModel::where('cast1',$request->cast1)->first();

            if($cast1db != null){

                $cast1db->delete();

                return response()->json(['message' => 'like']);

            }else{

                $data['user_id'] = $request->user_id;
                $data['post_id'] = $request->post_id;
                $data['cast1'] = $request->cast1;
                $data['cast2'] = $request->cast2;

                $checklike = mowajahaModel::create($data);

                if($checklike){

                    if($request->user_id != $post->user_id){
                        $data['user_id'] = $post->user_id;
                        $data['sender_user_id'] = $request->user_id;
                        $data['text'] = 'أعجب بمواجهتك';
                        $data['type'] = 'like';
                        $data['post_Time'] = now()->getTimestampMs();
                        $data['place'] = 'user';
                        $data['post_id'] = $request->post_id;


                        NotificationModel::create($data);
                    }

                }


                return response()->json(['message' => 'unlike']);


            }


        }
        if($request->cast2 != null){

            $cast1db = mowajahaModel::where('cast2',$request->cast2)->first();

            if($cast1db != null){

                $cast1db->delete();

                return response()->json(['message' => 'like']);

            }else{

                $data['user_id'] = $request->user_id;
                $data['post_id'] = $request->post_id;
                $data['cast1'] = $request->cast1;
                $data['cast2'] = $request->cast2;

                $checklike = mowajahaModel::create($data);

                if($checklike){

                    if($request->user_id != $post->user_id){
                        $data['user_id'] = $post->user_id;
                        $data['sender_user_id'] = $request->user_id;
                        $data['text'] = 'أعجب بمواجهتك';
                        $data['type'] = 'like';
                        $data['post_Time'] = now()->getTimestampMs();
                        $data['place'] = 'user';
                        $data['post_id'] = $request->post_id;


                        NotificationModel::create($data);
                    }

                }


                return response()->json(['message' => 'unlike']);


            }


        }


    }


    public function CheckLikemowajaha(Request $request)
    {

        if($request->cast1 != null){

            $cast1db = mowajahaModel::where('cast1',$request->cast1)->first();

            if($cast1db != null){

                return response()->json(['message' => 'like_cast1']);

            }else{


                return response()->json(['message' => 'unlike_cast1']);


            }


        }
        if($request->cast2 != null){

            $cast1db = mowajahaModel::where('cast2',$request->cast2)->first();

            if($cast1db != null){



                return response()->json(['message' => 'like_cast2']);

            }else{



                return response()->json(['message' => 'unlike_cast2']);


            }


        }


    }


    public function editcomment($id,Request $request)
    {

        $comment = Comments::find($id);


        $comment['content'] = $request->content;


        $addded = $comment->save();

        if($addded){


         return response()->json(['message' => 'added']);

        }else{
            return response()->json(['message' => 'error']);
        }



    }



}
