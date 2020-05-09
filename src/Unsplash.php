<?php
namespace Bhsec\SimpleImage;

class Unsplash
{
    protected const ACCESS_UNSPLASH = '9e33a4b9f59c0dbb71800d9eae09377d70c0de27c815b73a508f5f35dd6494ed';
    protected const SECRET_UNSPLASH = '56632e0c65b061c0235b1d4be6afe3e3ff100b4d0c082e81066bd986ea53ec8d';
    protected static $per_page = 15;
    protected static $orientation = 'landscape'; // 'portrait';

    public $full;
    public $regular;
    public $small;
    public $thumb;
    public $raw;

    function __construct($query)
    {
        \Crew\Unsplash\HttpClient::init(
            [
                'applicationId' => Unsplash::ACCESS_UNSPLASH,
                'secret' => Unsplash::SECRET_UNSPLASH,
                'utmSource' => 'simpleimage'
            ]
        );

        $result = \Crew\Unsplash\Search::photos(
            $query,
            rand(0, 15),
            Unsplash::$per_page,
            Unsplash::$orientation
        );
var_dump($result);
        $index = rand(0, 14);
        $this->full = $result[$index]['urls']['full'];
        $this->regular = $result[$index]['urls']['regular'];
        $this->small = $result[$index]['urls']['small'];
        $this->thumb = $result[$index]['urls']['thumb'];
        $this->raw = $result[$index]['urls']['raw'];
    }
}
