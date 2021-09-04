<?php

namespace App\Libraries;

use App\Http\Controllers\Controller;

/**
 * megambil video youtube dg APIs
 */
class YouTube extends Controller
{
    private $apikey;
    private $channel_id;

    public function __construct($apikey, $channel_id)
    {
        $this->apikey = $apikey;
        $this->channel_id = $channel_id;
    }

    public function get($keyword = "", $page = "", $maxResults = 9)
    {
        $json = file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$this->channel_id.'&maxResults='.$maxResults.'&q'.urlencode($keyword).'&key='.$this->apikey.'&pageToken='.$page);
        $array = json_decode($json);
        return $array;
    }

    public function search($keyword = "", $page = "")
    {
        $json = file_get_contents('https://www.googleapis.com/youtube/v3/search?type=video&part=snippet&channelId='.$this->channel_id.'&q='.urlencode($keyword).'&key='.$this->apikey.'&pageToken='.$page);
        $array = json_decode($json);
        return $array;
    }

    public function view($video = "")
    {
        $json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$video.'&key='.$this->apikey.'&part=snippet,statistics');
        $array = json_decode($json);
        return $array;
    }
}
