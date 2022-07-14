<?php

namespace Timetracking\Server\Service;

class RandomService
{
    /**
     * Fetches a random number for using as a seed from an external source.
     *
     * @return int
     */
    public static function getSeed() : int
    {
        return (int)hexdec(md5(file_get_contents("https://sdo.gsfc.nasa.gov/assets/img/latest/latest_4096_0171.jpg")));
    }
}