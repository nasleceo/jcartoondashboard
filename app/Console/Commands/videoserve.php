<?php

namespace App\Console\Commands;

use Carbon\CarbonInterval;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Filters\Video\ResizeFilter;
use FFMpeg\Filters\Video\VideoFilters;
use FFMpeg\Format\Audio\Aac;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Exporters\EncodingException;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use ProtoneMedia\LaravelFFMpeg\Filesystem\Media;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class videoserve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videoserve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $video_path = storage_path('app/public/') . '1.mp4';

        $intro_1080 = storage_path('app/public/') . '/intro' . '/' .  'intro.mp4';
        $intro_720 = storage_path('app/public/') . '/intro' . '/' . 'intro_720.mp4';
        $intro_480 = storage_path('app/public/') . '/intro' . '/' .  'intro_480.mp4';


        $video_out = storage_path('app/public/') . 'anass.mp4';




        $introformat = $this->getVideoDemantion($video_path);

        if ($introformat === '1920x1080') {


            $cmd =   'ffmpeg -i  ' . $intro_1080 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out;
        } else if ($introformat === '1280x720') {

            $cmd =   'ffmpeg -i  ' . $intro_720 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out;
        } else if ($introformat === '854x480') {

            $cmd =   'ffmpeg -i  ' . $intro_480 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out;
        } else {

            $cmd =   'ffmpeg -i  ' . $intro_480 . ' -i ' . $video_path . '   -filter_complex "[0:v] [0:a] [1:v] [1:a] concat=n=2:v=1:a=1 [v] [a]"  -map "[v]" -map "[a]" ' . $video_out;
        }







         shell_exec($cmd);


        $this->info('start');
        // $resoll = $this->getVideoFormats($video_out);



        // foreach ($resoll as $key) {
        //     $this->info($key['resolution']);
        //     $this->info('yesterday_' . $key['resolution'] . '.mp4');

        //     try {

        //         // FFMpeg::fromDisk('public')
        //         // ->open(['1.mp4'])
        //         // ->getFrameFromSeconds(100)
        //         // ->export()
        //         // ->onProgress(function ($progress) {
        //         //     $this->info("Progress: {$progress}%");
        //         // })
        //         // ->toDisk('videosepe')
        //         // ->inFormat($key['inFormat'])
        //         // ->save('optionn/yesterday_'.$key['resolution'].'.png');


        //         FFMpeg::fromDisk('public')
        //             ->open('anass.mp4')
        //             ->addFilter(function ($filters) use ($key) {
        //                 $filters->resize($key['dimension']);
        //             })

        //             ->export()
        //             ->onProgress(function ($progress) {
        //                 $this->info("Progress: {$progress}%");
        //             })
        //             ->toDisk('videosepe')
        //             ->inFormat($key['inFormat'])
        //             ->save('anyoo/yesterday_' . $key['resolution'] . '.mp4');
        //     } catch (EncodingException $exception) {
        //         $command = $exception->getCommand();
        //         $errorLog = $exception->getErrorOutput();
        //         $this->info($command);
        //         $this->info($errorLog);
        //     }
        // }


        try {
        } catch (EncodingException $exception) {
            $command = $exception->getCommand();
            $errorLog = $exception->getErrorOutput();
            $this->info($command);
            $this->info($errorLog);
        }
    }
    function getSecondsFromHMS($time)
    {

        $timeArr = array_reverse(explode(":", $time));
        $seconds = 0;
        foreach ($timeArr as $key => $value) {
            if ($key > 2)
                break;
            $seconds += pow(60, $key) * $value;
        }

        return CarbonInterval::seconds($seconds)->cascade()->forHumans();;
    }
    public function getVideoFormats($filePath)
    {
        $ffprobe = FFProbe::create();
        $this->info($filePath);
        // Get the resolution of the video
        $resolution = $ffprobe->streams($filePath)->videos()->first()->get('width') . 'x' . $ffprobe->streams($filePath)->videos()->first()->get('height');
        $video_durition = $ffprobe->streams($filePath)->videos()->first()->get('duration');
        $video_size = $ffprobe->streams($filePath)->videos()->first()->get('size');
        //$headers = get_headers($filePath, true);
        $this->info($this->getSecondsFromHMS($video_durition));
        $this->info('--------------------------------');
        //$this->info($this->formatSizeUnits($headers['Content-Length']));

        // Create 1080p and lower video if the resolution is higher than 1080p
        if ($resolution === '1920x1080') {
            $formats = [
                ['resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'), 'inFormat' => (new X264)->setKiloBitrate(800), 'event' => 'video.converted.480p', 'dimension' => new Dimension(854, 480)],
                ['resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'), 'inFormat' => (new X264)->setKiloBitrate(700), 'event' => 'video.converted.3600p', 'dimension' => new Dimension(640, 360)],
                ['resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'), 'inFormat' => (new X264)->setKiloBitrate(400), 'event' => 'video.converted.240p', 'dimension' => new Dimension(426, 240)],
                ['resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'), 'inFormat' => (new X264)->setKiloBitrate(200), 'event' => 'video.converted.144p', 'dimension' => new Dimension(256, 144)],

            ];
        }


        // Create 720p and lower video if the resolution is higher than 720p
        else if ($resolution === '1280x720') {
            $formats = [
                ['resolution' => '480p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(800), 'event' => 'video.converted.480p', 'dimension' => new Dimension(854, 480)],
                ['resolution' => '360p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(700), 'event' => 'video.converted.360p', 'dimension' => new Dimension(640, 360)],
                ['resolution' => '240p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(400), 'event' => 'video.converted.240p', 'dimension' => new Dimension(426, 240)],
                ['resolution' => '144p', 'format' => new X264('aac', 'libx264', 'mp4'),  'inFormat' => (new X264)->setKiloBitrate(200), 'event' => 'video.converted.144p', 'dimension' => new Dimension(256, 144)],

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

    public function getVideoDemantion($filePath)
    {
        $ffprobe = FFProbe::create();
        $this->info($filePath);
        // Get the resolution of the video
        $resolution = $ffprobe->streams($filePath)->videos()->first()->get('width') . 'x' . $ffprobe->streams($filePath)->videos()->first()->get('height');

        return $resolution;
    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
