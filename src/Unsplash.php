<?php
namespace Bhsec\SimpleImage;

class Unsplash
{
    protected static $access_unsplash = '9e33a4b9f59c0dbb71800d9eae09377d70c0de27c815b73a508f5f35dd6494ed';
    protected static $secret_unsplash = '56632e0c65b061c0235b1d4be6afe3e3ff100b4d0c082e81066bd986ea53ec8d';
    protected static $page = 15;
    protected static $per_page = 15;
    protected static $orientation = 'landscape';// 'portrait';
    public $result_full;
    public $result_regular;
    public $result_small;
    public $result_thumb;
    public $result_raw;

    function __construct($query)
    {
        \Crew\Unsplash\HttpClient::init(
            [
                'applicationId' => self::$access_unsplash,
                'secret' => self::$secret_unsplash,
                'utmSource' => 'simpleimage'
            ]
        );

        $result = \Crew\Unsplash\Search::photos($query, self::$page, self::$per_page, self::$orientation);
        $index = rand(0, 14);
        $this->result_full = $result[$index]['urls']['full'];
        $this->result_regular = $result[$index]['urls']['regular'];
        $this->result_small = $result[$index]['urls']['small'];
        $this->result_thumb = $result[$index]['urls']['thumb'];
        $this->result_raw = $result[$index]['urls']['raw'];
    }
}
