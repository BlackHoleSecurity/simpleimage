<?php
require __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use Bhsec\SimpleImage\Gambar;
use Bhsec\SimpleImage\Unsplash;

class StackTest extends TestCase
{
    function testGambar()
    {
        $gambar = new Gambar('Hello World', 'Dark', 'FSEX300.ttf'); // paragraf, query unsplash, font name
        $result = $gambar->getResult('result.jpg', 'image/jpeg', 50); // filename, mime, quality
        return $result;
    }
}
