<?php
namespace Bhsec\SimpleImage\Templates;

class QuoteTemplates extends Templates
{
   public static function make(array $opt)
    {
        $text = $opt['text'];
        $waterMark = $opt['watermark'];
        $font = $opt['font'];
        $query = $opt['query'];
        $outputName = $opt['result']['output'];
        $mime = $opt['result']['mime'];
        $quality = $opt['result']['quality'];

        try {
             $option1 = [
                // main text
                'color' => 'white',
                'size' => 130,
                'anchor' => 'center',
                'fontFile' =>
                    parent::SOURCE . DIRECTORY_SEPARATOR . $font,
                'xOffset' => -55,
                'yOffset' => -(strlen($text) * 2 - 150),
                'shadow' => [
                    // shadow option
                    'x' => 12,
                    'y' => 12,
                    'color' => 'black',
                ],
            ];

            $option2 = [
                // watermark text
                'color' => 'white',
                'size' => 130,
                'anchor' => 'center',
                'fontFile' =>
                    parent::SOURCE . DIRECTORY_SEPARATOR . $font,
                'xOffset' => -80,
                'yOffset' => 600,
                'shadow' => [
                    // shadow option
                    'x' => 12,
                    'y' => 12,
                    'color' => 'black',
                ],
            ];
            $image = new \claviska\SimpleImage();
            $unsplash = new \Bhsec\SimpleImage\Unsplash($query);
 
            $image
                ->fromString(file_get_contents($unsplash->regular))
                ->resolution(320, 200)
                ->resize(2016, 2016)
                ->autoOrient()
                ->text(parent::filterParagraf($text, 35), $option1)
                ->text(parent::filterParagraf($waterMark, 35), $option2)
                ->toFile($outputName, $mime, $quality);

            $return = [
                'Exif' => $image->getExif(),
                'Orientation' => $image->getOrientation(),
                'Resolution' => $image->getResolution(),
                'AspectRatio' => $image->getAspectRatio(),
            ];

            return json_encode(
                $return,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
