<?php

namespace Bhsec\SimpleImage\Templates;

class BhsecTemplates extends Templates
{
    public static function make(array $opt): array
    {
        $text = $opt['text'];
        $font = $opt['font'];
        $query = $opt['query'];
        $outputName = $opt['result']['output'];
        $mime = $opt['result']['mime'];
        $quality = $opt['result']['quality'];

        try {
            $option1 = [
                // main text
                'color' => 'white',
                'size' => 88,
                'anchor' => 'center',
                'fontFile' => parent::SOURCE . $font,
                'xOffset' => -30,
                'yOffset' => -(strlen($text) * 2 - 150),
                'shadow' => [
                    // shadow option
                    'x' => 12,
                    'y' => 12,
                    'color' => 'black',
                ],
            ];

            $option2 = [
                // bottom text 1
                'color' => 'white',
                'size' => 50,
                'anchor' => 'bottom left',
                'fontFile' => parent::SOURCE . $font,
                'xOffset' => 100,
            ];

            $option3 = [
                // bottom text 2
                'color' => 'white',
                'size' => 50,
                'anchor' => 'bottom left',
                'xOffset' => 405,
                'fontFile' => parent::SOURCE . $font,
            ];

            $option4 = [
                // top text 1
                'shadow' => [
                    // shadow option
                    'x' => 5,
                    'y' => 5,
                    'color' => 'black',
                ],
                'color' => 'white',
                'size' => 50,
                'anchor' => 'top right',
                'xOffset' => -400,
                'yOffset' => 140,
                'fontFile' => parent::SOURCE . $font,
            ];

            $container = parent::getContainer();
            $container['query'] = $query;
            $tele = $container['image'];
            $fb = $container['image'];
            $bhs = $container['image'];
            $image = $container['image'];
            $unsplash = $container['unsplash_regular'];

            $tele->fromFile(parent::SOURCE . 'telegram.png')->resize(80, 80);
            $fb->fromFile(parent::SOURCE . 'facebook.png')->resize(100, 90);
            $bhs->fromFile(parent::SOURCE . 'bhs.png')->resize(350, 350);

            $image
                ->fromString($unsplash)
                ->resolution(320, 200)
                ->resize(2016, 2016)
                ->autoOrient()
                ->text(parent::filterParagraf($text, 35), $option1)
                ->overlay($tele, 'bottom left')
                ->text('BHSec', $option2)
                ->overlay($bhs, 'top right')
                ->text('Did you know?', $option4)
                ->overlay($fb, 'bottom left', 1, 280)
                ->text('BHSecOfficial', $option3)
                ->toFile($outputName, $mime, $quality);

            return [
                'Exif' => $image->getExif(),
                'Orientation' => $image->getOrientation(),
                'Resolution' => $image->getResolution(),
                'AspectRatio' => $image->getAspectRatio(),
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
