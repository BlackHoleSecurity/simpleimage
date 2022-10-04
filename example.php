<?php

require __DIR__ . '/vendor/autoload.php';

if (!isset($argv[1])) {
    $paragraf = \Wheeler\Fortune\Fortune::make();
} else {
    $paragraf = $argv[1];
}

$query = 'Dark';
$waterMark = 'Cvar1984';
$optionQuote = [
    'text' => $paragraf,
    'watermark' => $waterMark,
    'query' => $query,
    'font' => 'Shadow Brush.ttf',
    'result' => [
        'output' => 'quote.jpg',
        'mime' => 'image/jpeg',
        'quality' => 100,
    ],
];

try {
    $status = Bhsec\SimpleImage\Templates\QuoteTemplates::make($optionQuote);
} catch(Exception $e) {
    $status = $e;
}
var_dump($status);
