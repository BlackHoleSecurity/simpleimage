<?php

require __DIR__ . '/vendor/autoload.php';

use Bhsec\SimpleImage\Gambar;

$paragraf = "bihun adalah bahasa pemrograman interpretatif multiguna dengan filosofi perancangan yang berfokus pada tingkat keterbacaan kode.";
$gambar = new Gambar($paragraf, 'Blur');
$result = $gambar->getResult('result.jpg', 'image/jpeg', 10); // filename, mime, quality
echo $result;
