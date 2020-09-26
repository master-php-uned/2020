<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Youtube
{
    const API_KEY = 'AIzaSyDpBZ4Zmdfjhm4SS_acR32pHEYw0MFXcxs';

    /**
     * Youtube constructor.
     */
    public function __construct()
    {
        $this->Watch();
    }

    public function Watch()
    {
        // Obtengo donde tengo el puntero para ver donde me quede en la cola de trbajo
        $pointer = Pointer::get()->first();

        // obtengo de la cola que tengo observando, el registro donde me quede con el puntero
        $observer = Observer::where('localizador', '=', $pointer->localizador)->first();

        if($observer != null)
        {
            // Obtengo el sigueinte tambien para mover el puntero
            $next = Observer::where('id', '>', $observer->id)->orderBy('id')->first();

            // en caso de que sea null
            if($next == null)
            {
                // Recupero el primero
                $next = Observer::get()->first();
            }

            // Actualizo el puntero
            $pointer->update(array('localizador' => $next->localizador));


            switch ($observer->reference)
            {
                case "video":

                    // Obtengo el video con el localizador
                    $video = Video::where('url', '=', $observer->localizador)->first();

                    if($video != null) {


                        switch ($video->status){

                            case 'update-video-data':

                                $lastRevision = Carbon::parse($video->updated_at->format('d.m.Y'))->diffInDays(Carbon::now());

                                if ($lastRevision > -10) {
                                    // Actualizado los datos del video
                                    $video->update(array(
                                            'data' => $this->GetDataVideo($observer->localizador),
                                            'status' => 'update-video-data')
                                    );

                                    // Registro la actualizacion de datos
                                    Registry::Record('video', $observer->localizador, 'update-video-data');
                                }
                                break;

                            case '':

                                // Actualizado los datos del video
                                $video->update(array(
                                        'data' => $this->GetDataVideo($observer->localizador),
                                        'status' => 'update-video-data')
                                );

                                // Registro la actualizacion de datos
                                Registry::Record('video', $observer->localizador, 'update-video-data');

                                break;
                        }
                    }


                    break;
                case "channel":

                    $containPageToken = Str::contains($observer->localizador, ['###']);
                    $canal = $observer->localizador;
                    if($containPageToken)
                    {
                        $splits = explode('##',$observer->localizador);
                        $canal = $splits[0];
                    }

                    // Obtengo el channel con el localizador
                    $channel = Channel::where('url', '=', $canal)->first();


                    $items = $this->GetVideosFromChannel($observer->localizador);

                    foreach ($items as $videos) {

                        foreach ($videos as $video) {
                            if (isset($video->id->kind) && ($video->id->kind == 'youtube#video')) {
                                echo $video->id->videoId;

                                Video::create([
                                    'parent' => $channel->id,
                                    'url' => $video->id->videoId,
                                    'data' => '',
                                    'status' => ''
                                ]);

                                // Registro la actualizacion de datos
                                Registry::Record('video',$video->id->videoId,'add-video');

                                Registry::Observer('video',$video->id->videoId,'add-video');
                            }
                        }
                    }


                    echo "work channel";
                    break;
            }
        }
    }


    public function GetVideosFromChannel(string $canal)
    {
        $listItem = [];

        $next = '';

        $containPageToken = Str::contains($canal, ['###']);

        if($containPageToken)
        {
            $splits = explode("###",$canal);

            $nextPageToken = $splits[1];
            $canal = $splits[0];
            $next = '&pageToken=' . $nextPageToken;
        }

        echo $next;

        $url ='https://www.googleapis.com/youtube/v3/search?part=id&channelId=' . $canal . '&maxResults=50&order=date&key=' . YOUTUBE::API_KEY . $next;
        echo  $url . " ";

        $json = file_get_contents($url);

        $obj = json_decode($json);

        if($obj != null)
        {
            if(isset($obj->pageInfo->totalResults) && $obj->pageInfo->totalResults > 0)
            {
                array_push($listItem, $obj->items);
                if(isset($obj->nextPageToken))
                {
                    Registry::Observer('channel', $canal . '###' . $obj->nextPageToken , '');
                    $pointer = Pointer::get()->first();
                    $pointer->update(array('localizador' => $canal . '###' . $obj->nextPageToken));
                }
            }
        }

        return $listItem;

    }


    public function GetDataVideo(string $localizador):string
    {
        return file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet&part=statistics&part=contentDetails&part=status&id=' . $localizador . '&key=' . YOUTUBE::API_KEY );
    }


    public function handle()
    {

    }
}

/**** comando a ejecutar para correr la tarea  ****/
// php artisan schedule:run
