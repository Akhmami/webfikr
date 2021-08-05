<?php

namespace App\Libraries;

class SheetDB
{
    private static $url;

    public static function get($url)
    {
        self::$url = $url;

        $options = array(
            'http' => array(
                'method'  => 'GET'
            )
        );

        $result = json_decode(
            file_get_contents(self::$url, false, stream_context_create($options))
        );

        return $result;
    }

    public static function first($url, $casesensitive = true)
    {
        self::$url = $url . "&casesensitive={$casesensitive}&limit=1";

        $options = array(
            'http' => array(
                'method'  => 'GET'
            )
        );

        $result = json_decode(
            file_get_contents(self::$url, false, stream_context_create($options))
        );

        return $result;
    }
}
