<?php

namespace Bhsec\SimpleImage;

class Unsplash
{
    private $unsplashAccess;
    private $unsplashSecret;
    protected static $per_page = 15;
    protected static $orientation = 'landscape'; // 'portrait';

    public $full;
    public $regular;
    public $small;
    public $thumb;
    public $raw;

    public function __construct($query)
    {
        \Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();
        $this->unsplashAccess = $_ENV['ACCESS_UNSPLASH'];
        $this->unsplashSecret = $_ENV['SECRET_UNSPLASH'];

        \Crew\Unsplash\HttpClient::init([
            'applicationId' => $this->unsplashAccess,
            'secret' => $this->unsplashSecret,
            'utmSource' => 'simpleimage',
        ]);

        $result = \Crew\Unsplash\Search::photos(
            $query,
            rand(0, 15),
            self::$per_page,
            self::$orientation
        );

        $index = rand(0, 14);
        $this->full = $result[$index]['urls']['full'];
        $this->regular = $result[$index]['urls']['regular'];
        $this->small = $result[$index]['urls']['small'];
        $this->thumb = $result[$index]['urls']['thumb'];
        $this->raw = $result[$index]['urls']['raw'];
    }
}

