<?php
namespace Bhsec\SimpleImage\Templates;

class BhsecTemplates
{
    protected const SOURCE = __DIR__ . '/../../assets';
    private static function filterParagraf(string $paragraf, string $wrap)
    {
        $paragraf = trim($paragraf);
        $paragraf = mb_substr($paragraf, 0, 301, 'UTF-8');
        $paragraf = str_replace('. ', ".\n", $paragraf);
        $paragraf = wordwrap($paragraf, $wrap, "\n");
        $paragraf = ucwords(strtolower($paragraf));
        return $paragraf;
    }

    public static function make(array $opt)
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
                'fontFile' =>
                    BhsecTemplates::SOURCE . DIRECTORY_SEPARATOR . $font,
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
                // bottom text 1
                'color' => 'white',
                'size' => 50,
                'anchor' => 'bottom left',
                'fontFile' =>
                    BhsecTemplates::SOURCE . DIRECTORY_SEPARATOR . $font,
                'xOffset' => 100,
            ];

            $option3 = [
                // bottom text 2
                'color' => 'white',
                'size' => 50,
                'anchor' => 'bottom left',
                'xOffset' => 405,
                'fontFile' =>
                    BhsecTemplates::SOURCE . DIRECTORY_SEPARATOR . $font,
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
                'fontFile' =>
                    BhsecTemplates::SOURCE . DIRECTORY_SEPARATOR . $font,
            ];

            $tele = new \claviska\SimpleImage();
            $fb = new \claviska\SimpleImage();
            $bhs = new \claviska\SimpleImage();
            $image = new \claviska\SimpleImage();
            $unsplash = new \Bhsec\SimpleImage\Unsplash($query);

            $tele
                ->fromFile(BhsecTemplates::SOURCE . '/telegram.png')
                ->resize(80, 80);
            $fb
                ->fromFile(BhsecTemplates::SOURCE . '/facebook.png')
                ->resize(100, 90);
            $bhs
                ->fromFile(BhsecTemplates::SOURCE . '/bhs.png')
                ->resize(350, 350);

            $image
                ->fromString(file_get_contents($unsplash->regular))
                ->resolution(320, 200)
                ->resize(2016, 2016)
                ->autoOrient()
                ->text(BhsecTemplates::filterParagraf($text, 35), $option1)
                ->overlay($tele, 'bottom left')
                ->text('BHSec', $option2)
                ->overlay($bhs, 'top right')
                ->text('Did you know?', $option4)
                ->overlay($fb, 'bottom left', 1, 280)
                ->text('BHSecOfficial', $option3)
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
