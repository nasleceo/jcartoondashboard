<?php

namespace App\Http\Controllers;

use App\Http\Requests\TvRequest;
use App\Models\allvideos;
use App\Models\episodemodel;
use App\Models\Movie;
use App\Models\server;
use App\Models\TV;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MovieController extends Controller
{


    public function show(){

        $movie = TV::where('place','LIKE', '%' . 'movie' . '%')->with('rate')->withCount('Views')->with('tawsiat')->with('episdoes')->with('comments')->get();

        return View('layouts.movie.movie',compact('movie'));

    }


    public function addmovieview(){

        return View('layouts.movie.addmovie');

    }


    public function addmovie(TvRequest $request){


        $request->validated($request->all());


        $data['title'] = $request->title;
        $data['poster'] = $request->poster;
        $data['cover'] = $request->cover;
        $data['year'] = $request->year;
        $data['place'] = $request->status.','.'movie';
        $data['gener'] = $request->gener;
        $data['country'] = '';
        $data['age'] = $request->agerate;
        $data['story'] = $request->story;
        $data['tmdb_id'] = $request->tmdbid;

        $movie = TV::create($data);
        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';


    }



    public function getmovieFromTMDB(Request $request){


        $request->validate(['tmdbid' => 'required']);

        $tmdb = $request->tmdbid;


        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/'.$tmdb. '?api_key='.config('services.tmdb.api').'&language=ar-SA');




            if (empty($data['original_title'])){

                return back()->with('akhta', 'The TMDB code its not working');
            }


        return $data;
    }


    public function editshow($id){

        $tv = TV::findOrFail($id);

        return View('layouts.movie.editmovie',compact('tv'));

    }


    public function Editmovie($id,Request $request){


        $movie = TV::find($id);

        $movie['title'] = $request->title;
        $movie['poster'] = $request->poster;
        $movie['cover'] = $request->cover;
        $movie['year'] = $request->year;
        $movie['place'] = $request->status.','.'movie';
        $movie['gener'] = $request->gener;
        $movie['country'] = $request->country;
        $movie['age'] = $request->agerate;
        $movie['story'] = $request->story;
        $movie['tmdb_id'] = $request->tmdbid;

        $movie->save();

        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';


    }

    public function showviedoes($id){

        $tv = TV::findOrFail($id);
        $video = episodemodel::where('tv_id', $id)->get();
        return View('layouts.movie.videomovie',compact('tv','video'));

    }

    public function movievideosEdit($id){

        $video = episodemodel::findOrFail($id);
        $tv = TV::where('id', $video->tv_id)->first();


        return View('layouts.movie.editvideomovie',compact('tv','video'));

    }
    public function moviegovideos($id,Request $request){


        $data['lebel'] =  $request->title;
        $data['tv_id'] = $id;
        $data['season_id'] = "";
        $data['source'] = $request->source;
        $data['url'] = $request->url;
        $data['url_modablaj'] = $request->url_modablaj;
        $data['message'] = $request->message;
        $data['status'] = $request->status;
        $data['type'] = 'movie';

        $video = episodemodel::create($data);
        if (!$video) {
            return 'خطا في إدخال المعلومات';
        }

        return redirect(route('editmovie',$id));;
    }

    public function movievideoEdit($id,Request $request){

        $video = episodemodel::Find($id);



        $video['lebel'] = $request->name;
        $video['tv_id'] = $request->id;
        $video['source'] = $request->source;
        $video['url'] = $request->url;
        $data['url_modablaj'] = $request->url_modablaj;
        $data['message'] = $request->message;
        $video['status'] = $request->status;
        $video['type'] = 'movie';

        $video->save();

        if (!$video) {
            return 'خطا في إدخال المعلومات';
        }
        return Response()->json($video->movie_id);



    }


    function deletmovie($id)
    {


        $movie = TV::findOrFail($id);
        $movie->delete();


    }

    function deletmovievideo($id)
    {


        $movie = episodemodel::findOrFail($id);
        $movie->delete();
        return redirect(route('showviedoes',$movie->movie_id));;



    }


    public function servers($id){


        $epe = episodemodel::findOrFail($id);
        $servers = server::where('epe_id',$id)->get();



        return View('layouts.tv.servers',compact('epe','servers'));

    }



    function deletservers($id)
    {


        $movie = server::findOrFail($id);
        $movie->delete();


    }


    public function addservers($id,Request $request){


        $data['lebel'] = $request->lebel;
        $data['source'] = $request->source;
        $data['url'] = $request->url;
        $data['type'] = 'server_url';
        $data['epe_id'] = $id;

        $video = server::create($data);


        if (!$video) {
            return redirect(route('SeasonsVideoshow',$id))->with('error','There is Problem With Add Video');
        }
        return Response()->json("تم إضافة السيرفر");
    }


}
