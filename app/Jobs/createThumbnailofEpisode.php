<?php

namespace App\Jobs;

use App\Models\episodemodel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg ;

class createThumbnailofEpisode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     public $video;
    public function __construct(episodemodel $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $disitination = '/'.'epescreenshots'. '/' . $this->video->id .'.png';


        if ($this->video->type == 'url') {


            FFMpeg::openUrl('https://zqvnzsxicfeh.sw-cdnstream.com/hls2/01/02013/3lwp514s6dd5_,n,h,x,.urlset/index-f2-v1-a1.m3u8?t=mdeg-20r4Q21EvLXv_qD-TTKrxKrXSIGKtuF7FwGsn8&s=1697716858&e=129600&f=10069427&srv=nkLOLP4B1HAm&i=0.4&sp=500&p1=nkLOLP4B1HAm&p2=nkLOLP4B1HAm&asn=36925')
            ->getFrameFromSeconds(2)
            ->export()
            ->onProgress(function ($progress) {
                info("Progress: {$progress}%");
            })
            ->toDisk('videosepe')
            ->save('optionn/yesterday_'.$this->video->id.'.png');




            $this->video['imageofepe_url'] = storage_path('app/public').$disitination;

            $this->video->save();


        }else {


            FFMpeg::fromDisk('public')
            ->open('/'.$this->video->url)
            ->getFrameFromSeconds(10)
            ->export()
            ->toDisk('public')
            ->save($disitination);


            $this->video['imageofepe_url'] = '/storage'.$disitination;

            $this->video->save();


        }






    }
}
