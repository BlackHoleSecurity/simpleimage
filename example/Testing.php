<?php
require __DIR__.'/../vendor/autoload.php';
use Bhsec\SimpleImage\Gambar;
use Bhsec\SimpleImage\Unsplash;
$gambar=new Gambar('Hello World', 'Dark', 'FSEX300.ttf'); // paragraf, query unsplash, font name
$gambar->getResult('result.jpg','image/jpeg',50); // filename, mime, quality
