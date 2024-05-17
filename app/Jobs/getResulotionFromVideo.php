<?php

namespace App\Jobs;

use App\Models\episodemodel;
use App\Models\TV;
use App\Models\video;
use Carbon\CarbonInterval;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process as FacadesProcess;
use ProtoneMedia\LaravelFFMpeg\Exporters\EncodingException;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Symfony\Component\Process\Process;

class getResulotionFromVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $video;
    public $video_durition;

    public function __construct(episodemodel $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


        $intro_1080 = storage_path('app/public/') .'intro'.'/'.  'intro.mp4';
        $intro_720 = storage_path('app/public/') .'intro'.'/'. 'intro_720.mp4';
        $intro_480 = storage_path('app/public/') .'intro'.'/'.  'intro_480.mp4';


        $video_path = storage_path('app/public/') . $this->video->url;

        $video_out = storage_path('app/public/') .'mainaa'.'.mp4';


        // $introformat = $this->getVideoDemantion($video_path);

        // $cmd = '';

        // if ($introformat === '1920x1080') {


        //     $cmd =   'ffmpeg -i  ' . $intro_1080 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out ;

        // }  else if ($introformat === '1280x720') {

        //     $cmd =   'C:\ffmpge\ffmpeg -i  ' . $intro_720 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]"  ahlam.mp4'  ;


        // }  else if ($introformat === '854x480') {

        //     $cmd =   'ffmpeg -i  ' . $intro_480 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out ;

        // } else {

        //     $cmd =   'C:\ffmpge\ffmpeg -i  ' . $intro_480 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out ;

        // }


        // exec($cmd);



        $resoll = $this->getVideoFormats($video_path);

        $cartoon = $this->video->video_cartoon;
        $season = $this->video->video_season;


        $cartoontitle  = str_replace(array(":"," ","."), '', $cartoon->title);

        $seasontitle  = str_replace(array(" الموسم "), '', $season->name);

        foreach ($resoll as $key) {


            $disiti = $cartoontitle.'/seasons'.'/'.$season->name.'/episodes'.'/'.$this->video->lebel.'/'.'S'.$seasontitle.'E'.$this->video->lebel.'_'.$key['resolution'].'.mp4';

            try {


            FFMpeg::fromDisk('public')
            ->open( $this->video->url)

            ->addFilter(function ($filters) use ($key)  {
                $filters->resize($key['dimension']);
            })
            ->export()
            ->onProgress(function ($progress) {


                $this->video->update([
                    "processing_percentage" => $progress
                ]);

            })
            ->toDisk('public')
            ->inFormat($key['inFormat'])
            ->save($disiti);



            $data['lebel'] = $this->video->lebel;
            $data['tv_id'] = $cartoon->id;
            $data['epe_id'] = $this->video->id;
            $data['quality'] = $key['resolution'];
            $data['size'] = $this->getSecondsFromHMS($this->video_durition);
            $data['url'] =  $disiti;
            $data['processed_file'] = 1;
            $data['processed'] = true;
            $data['processing_percentage'] = 100;
            $data['type'] = 'upload_video';

            video::create($data);


            } catch (EncodingException $exception) {
                $command = $exception->getCommand();
                $errorLog = $exception->getErrorOutput();


            }
        }



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
    public function getVideoDemantion($filePath){
        $ffprobe = FFProbe::create();
        $resolution = $ffprobe->streams($filePath)->videos()->first()->get('width') . 'x' . $ffprobe->streams($filePath)->videos()->first()->get('height');

        return $resolution;
    }

    public function getVideoFormats($filePath)
    {
        $ffprobe = FFProbe::create();
        info($filePath);
        // Get the resolution of the video
        $resolution = $ffprobe->streams($filePath)->videos()->first()->get('width') . 'x' . $ffprobe->streams($filePath)->videos()->first()->get('height');
        $this->video_durition = $ffprobe->streams($filePath)->videos()->first()->get('duration');
        $video_size = $ffprobe->streams($filePath)->videos()->first()->get('size');
        //$headers = get_headers($filePath, true);
        info($this->getSecondsFromHMS($this->video_durition));
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
