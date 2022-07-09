<?php

namespace App;

class Random
{
    /**
     * Fetches a random number for using as a seed from an external source.
     * URL: http://www.randomnumberapi.com/api/v1.0/random?min=1000&max=1000000000&count=1
     *
     * @return int
     */
    public static function getSeed() : int
    {
        $url = 'http://www.randomnumberapi.com/api/v1.0/random?min=1000&max=1000000000&count=1';
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        return current($data);
    }
}