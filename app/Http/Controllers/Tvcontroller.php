<?php

namespace App\Http\Controllers;

use App\Http\Requests\TvRequest;
use App\Jobs\createThumbnailofEpisode;
use App\Jobs\getResulotionFromVideo;
use App\Models\episodemodel;
use App\Models\SeasonModel;
use App\Models\server;
use App\Models\TV;
use Carbon\CarbonInterval;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;

class Tvcontroller extends Controller
{


    public function show(){

        $tv = TV::where('place','LIKE', '%' . 'tv' . '%')->withCount('Views')->with('rate')->with('tawsiat')->with('comments')->orderByDesc('id')->get();


        return View('layouts.tv.tv',compact('tv'));

    }



    public function addtvview(){

        return View('layouts.tv.addtv');

    }


    public function addtv(TvRequest $request){


        $request->validated($request->all());


        $data['title'] = $request->title;
        $data['poster'] = $request->poster;
        $data['cover'] = $request->cover;
        $data['year'] = $request->year;
        $data['place'] = $request->status.','.'tv';
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


    public function gettvFromTMDB(Request $request){


        $request->validate(['tmdbid' => 'required']);

        $tmdb = $request->tmdbid;


        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'tv/'.$tmdb. '?api_key='.config('services.tmdb.api').'&language=ar-SA');

            if (empty($data['name'])){

                return back()->with('akhta', 'The TMDB code its not working');
            }


        return $data;
    }


    public function editshow($id){

        $tv = TV::findOrFail($id);

        return View('layouts.tv.edittv',compact('tv'));

    }


    public function Edittv($id,Request $request){


        $movie = TV::find($id);

        $movie['title'] = $request->title;
        $movie['poster'] = $request->poster;
        $movie['cover'] = $request->cover;
        $movie['year'] = $request->year;
        $movie['place'] = $request->status.','.'tv';
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


    function delettv($id)
    {


        $movie = TV::findOrFail($id);
        $movie->delete();
        return redirect(route('tv'));


    }


    public function SeasonsShow($id){

        $tv = TV::findOrFail($id);
        $seasons = SeasonModel::where('movie_id', $id)->with('episodes')->get();



        return View('layouts.tv.seasons',compact('tv','seasons'));

    }

    public function addseason($id,Request $request)
    {

        $data['name'] = ' الموسم '.$request->name;
        $data['movie_id'] = $id;
        $data['Episodes'] = episodemodel::where(['tv_id' => $id, 'season_id' => $request->id ])->count();
        $data['status'] = $request->status;


        $video = SeasonModel::create($data);
        if (!$video) {
            return redirect(route('showSeason', $id))->with('error', 'There is Problem With Add Video');
        }

    }

    public function Seasonseditshow($id){

        $seasons = SeasonModel::find($id);



        $tv = TV::where('id', $seasons->movie_id)->first();


        return View('layouts.tv.seasonsedit',compact('tv','seasons'));

    }

    public function editseason($id,Request $request)
    {

        $video = SeasonModel::find($id);
        $tv = TV::where('id', $video->movie_id)->first();


        $video['name'] = ' الموسم '.$request->name;
        $video['movie_id'] =  $tv->id;
        $video['Episodes'] = episodemodel::where(['tv_id' => $id, 'season_id' => $request->id ])->count();
        $video['status'] = $request->status;

        $video->save();

        if (!$video) {
            return redirect(route('showSeason', $id))->with('error', 'There is Problem With Add Video');
        }

        return redirect(route('showSeason', $tv->id));
    }

    public function SeasonsVideoshow($id){

        $seasons = SeasonModel::with('episodes')->find($id);

        $tv = TV::where('id', $seasons->movie_id)->first();

        $episodes = episodemodel::with('video_quality')->where(['tv_id' =>  $tv->id, 'season_id' => $seasons->id ])->get();


        return View('layouts.tv.seasonsvideos',compact('tv','episodes','seasons'));

    }

    public function videosseason($id,Request $request){


        $season = SeasonModel::find($id);
        $tv = TV::find($season->movie_id);



        if ($request->hasfile('video')) {

            $request->validate([
                'video' => 'mimes:mp4,mkv,avi'
            ]);

            $file = $request->file('video');
            $cartoontitle  = str_replace(array(":"," ","."), '', $tv->title);


            $extractpath = 'public/uploads_epe/'.$cartoontitle.'/seasons'.'/'.$season->name.'/episodes' ;


            $filename = $file->storeAs($extractpath, $request->name.'.mp4');


            $data['lebel'] = $request->name;
            $data['tv_id'] = $tv->id;
            $data['season_id'] = $season->id;
            $data['source'] = $request->source;
            $data['url'] = 'uploads_epe/'.$cartoontitle.'/seasons'.'/'.$season->name.'/episodes'.'/'.$request->name.'.mp4';
            $data['url_modablaj'] = $request->url_modablaj;
            $data['message'] = $request->message;
            $data['status'] = $request->status;
            $data['type'] = 'upload_video';

            $video = episodemodel::create($data);

            $finalvid = $video->video_cartoon;

            createThumbnailofEpisode::dispatch($video);

            getResulotionFromVideo::dispatch($video);




            return Response()->json($finalvid);


        }


https://egtpgrvh.sbs/e/xvokylbamwsl





        $data['lebel'] = $request->name;
        $data['tv_id'] = $tv->id;
        $data['season_id'] = $season->id;
        $data['source'] = $request->source;
        $data['url'] = $request->url;
        $data['url_modablaj'] = $request->url_modablaj;
        $data['message'] = $request->message;
        $data['status'] = $request->status;
        $data['type'] = 'tv';


        if ($request->skipablle == 1) {

            $data['skip_available'] = 1;
            $data['intro_start'] = $request->intro_start;
            $data['intro_end'] = $request->intro_end;

        }



        $video = episodemodel::create($data);


        // createThumbnailofEpisode::dispatch($video);

        // getResulotionFromVideo::dispatch($video);




        if (!$video) {
            return redirect(route('SeasonsVideoshow',$id))->with('error','There is Problem With Add Video');
        }
        return Response()->json($video);
    }



    function deletseason($id)
    {


        $movie = SeasonModel::findOrFail($id);
        $movie->delete();


    }


    function deletepe($id)
    {


        $movie = episodemodel::findOrFail($id);
        $movie->delete();


    }


    public function SeasonsVideoEditshow($id){

        $episodes = episodemodel::find($id);

        $tv = TV::where('id', $episodes->tv_id)->first();
        $seasons = SeasonModel::where('id', $episodes->season_id)->first();


        return View('layouts.tv.seasonsvideosEdit',compact('tv','episodes','seasons'));

    }

    public function Editvideosseason($id,Request $request){


        $episodes = episodemodel::find($id);


        $episodes['lebel'] = $request->name;
        $episodes['tv_id'] = $episodes->tv_id;
        $episodes['season_id'] = $episodes->season_id;
        $episodes['source'] = $request->source;
        $episodes['url'] = $request->url;
        $episodes['url_modablaj'] = $request->url_modablaj;
        $episodes['message'] = $request->message;
        $episodes['status'] = $request->status;
        $episodes['type'] = 'tv';


        if ($request->skipablle == 1) {

            $data['skip_available'] = 1;
            $data['intro_start'] = $request->intro_start;
            $data['intro_end'] = $request->intro_end;

        }


        $episodes->save();

        if (!$episodes) {

            return redirect(route('SeasonsVideoshow',$id))->with('error','There is Problem With Add Video');
        }
        return Response()->json($episodes->tv_id);

    }



    public function DeletAllEpe(Request $request)  {

        $ids = $request->ids;
        episodemodel::whereIn('id', $ids)->delete();

        return response()->json(["success"=> "تم حدف الحلقات بنجاح"]);


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


    function getSecondsFromHMS($time) {

        $timeArr = array_reverse(explode(":", $time));
        $seconds = 0;
        foreach ($timeArr as $key => $value) {
            if ($key > 2)
                break;
            $seconds += pow(60, $key) * $value;
        }

        return CarbonInterval::seconds($seconds)->cascade()->forHumans();        ;
    }
    public function getVideoFormats($filePath)
    {
        $ffprobe = FFProbe::create();
        info($filePath);
        // Get the resolution of the video
        $resolution = $ffprobe->streams($filePath)->videos()->first()->get('width') . 'x' . $ffprobe->streams($filePath)->videos()->first()->get('height');
        $video_durition = $ffprobe->streams($filePath)->videos()->first()->get('duration');
        $video_size = $ffprobe->streams($filePath)->videos()->first()->get('size');
        //$headers = get_headers($filePath, true);
        info($this->getSecondsFromHMS($video_durition));
        info('--------------------------------');
        //info($this->formatSizeUnits($headers['Content-Length']));

        // Create 1080p and lower video if the resolution is higher than 1080p
        if ($resolution === '1920x1080') {
            $formats = [
                ['resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'), 'inFormat' => (new X264)->setKiloBitrate(800),'event' => 'video.converted.480p', 'dimension' => new Dimension(854, 480)],
                ['resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'), 'inFormat' => (new X264)->setKiloBitrate(700),'event' => 'video.converted.3600p', 'dimension' => new Dimension(640, 360)],
                ['resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'),'inFormat' => (new X264)->setKiloBitrate(400), 'event' => 'video.converted.240p', 'dimension' => new Dimension(426, 240)],
                ['resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'),'inFormat' => (new X264)->setKiloBitrate(200),'event' => 'video.converted.144p', 'dimension' => new Dimension(256, 144)],

            ];
        }


        // Create 720p and lower video if the resolution is higher than 720p
        else if ($resolution === '1280x720') {
            $formats = [
                ['resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(800), 'event' => 'video.converted.480p', 'dimension' => new Dimension(854, 480)],
                ['resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(700), 'event' => 'video.converted.360p', 'dimension' => new Dimension(640, 360)],
                ['resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(400),'event' => 'video.converted.240p', 'dimension' => new Dimension(426, 240)],
                ['resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(200),'event' => 'video.converted.144p', 'dimension' => new Dimension(256, 144)],

            ];
        }
        // Create 480p video if the resolution is lower than 720p
        else if ($resolution === '854x480') {
            $formats = [
                ['resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'),   'inFormat' => (new X264)->setKiloBitrate(700),  'event' => 'video.converted.360p', 'dimension' => new Dimension(640, 360)],
                ['resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(400), 'event' => 'video.converted.240p', 'dimension' => new Dimension(426, 240)],
                ['resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(200), 'event' => 'video.converted.144p', 'dimension' => new Dimension(256, 144)],

            ];
        } else {
            $formats = [
                ['resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(800), 'event' => 'video.converted.480p', 'dimension' => new Dimension(854, 480)],
                ['resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'),   'inFormat' => (new X264)->setKiloBitrate(700),  'event' => 'video.converted.360p', 'dimension' => new Dimension(640, 360)],
                ['resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(400), 'event' => 'video.converted.240p', 'dimension' => new Dimension(426, 240)],

            ];
        }



        return $formats;
    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

}
