<?php

require __DIR__ . '/vendor/autoload.php';

$paragraf = 'bihun adalah bahasa pemrograman interpretatif multiguna dengan filosofi perancangan yang berfokus pada tingkat keterbacaan kode.';
$query = 'Dark';
$option = [
    'text' => $paragraf,
    'query' => $query,
    'font' => 'FSEX300.ttf',
    'result' => [
        'output' => 'result.jpg',
        'mime' => 'image/jpeg',
        'quality' => 100
    ]
];

$status = Bhsec\SimpleImage\Templates\BhsecTemplates::make($option);
echo $status;
