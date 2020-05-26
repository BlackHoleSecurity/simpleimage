<?php

require __DIR__ . '/vendor/autoload.php';

$paragraf = \Wheeler\Fortune\Fortune::make();
$query = 'Cyberpunk';
$waterMark = 'Cvar1984';
$optionQuote = [
    'text' => $paragraf,
    'watermark' => $waterMark,
    'query' => $query,
    'font' => 'Shadow Brush.ttf',
    'result' => [
        'output' => 'quote.jpg',
        'mime' => 'image/jpeg',
        'quality' => 100
    ]
];

$status = Bhsec\SimpleImage\Templates\QuoteTemplates::make($optionQuote);
var_dump($status);
