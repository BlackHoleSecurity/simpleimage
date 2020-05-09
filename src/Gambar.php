<?php
namespace Bhsec\SimpleImage;

class Gambar
{
    protected $option = array();
    protected $option2 = array();
    protected $option3 = array();
    protected $option4 = array();
    protected $src = __DIR__ . '/../assets';
    protected $text;
    protected $query;

    function __construct(
        $text = 'Hello World',
        $query = 'Dark',
        $font = 'FSEX300.ttf'
    )
    {
        $this->option = [
            // main text
            'color' => 'white',
            'size' => 88,
            'anchor' => 'center',
            'fontFile' => $this->src . DIRECTORY_SEPARATOR . $font,
            'xOffset' => -55,
            'yOffset' => -((strlen($text)*2)-150),
            'shadow' => [
                // shadow option
                'x' => 12,
                'y' => 12,
                'color' => 'black'
            ]
        ];

        $this->option2 = [
            // bottom text 1
            'color' => 'white',
            'size' => 50,
            'anchor' => 'bottom left',
            'fontFile' => $this->src . DIRECTORY_SEPARATOR . $font,
            'xOffset' => 100
        ];

        $this->option3 = [
            // bottom text 2
            'color' => 'white',
            'size' => 50,
            'anchor' => 'bottom left',
            'xOffset' => 405,
            'fontFile' => $this->src . DIRECTORY_SEPARATOR . $font
        ];

        $this->option4 = [
            // top text 1
            'shadow' => [
                // shadow option
                'x' => 5,
                'y' => 5,
                'color' => 'black'
            ],
            'color' => 'white',
            'size' => 50,
            'anchor' => 'top right',
            'xOffset' => -400,
            'yOffset' => 140,
            'fontFile' => $this->src . DIRECTORY_SEPARATOR . $font
        ];

        $this->text = $text;
        $this->query = $query;
    }

    private function filterParagraf(string $paragraf, string $wrap)
    {
        $paragraf = trim($paragraf);
        $paragraf = mb_substr($paragraf, 0, 301, 'UTF-8');
        $paragraf = str_replace('. ', ".\n", $paragraf);
        $paragraf = wordwrap($paragraf, $wrap, "\n");
        $paragraf = ucwords(strtolower($paragraf));
        return $paragraf;
    }

    public function getResult(string $result, string $mime, int $quality)
    {
        try {
            $tele = new \claviska\SimpleImage();
            $fb = new \claviska\SimpleImage();
            $bhs = new \claviska\SimpleImage();
            $image = new \claviska\SimpleImage();
            $unsplash = new \Bhsec\SimpleImage\Unsplash($this->query);

            $tele->fromFile($this->src . '/telegram.png')->resize(80, 80);

            $fb->fromFile($this->src . '/facebook.png')->resize(100, 90);

            $bhs->fromFile($this->src . '/bhs.png')->resize(350, 350);

            $image
                ->fromString(file_get_contents($unsplash->regular))
                ->resolution(320, 200)
                ->resize(2016, 2016)
                ->autoOrient()
                ->text(Gambar::filterParagraf($this->text, 35), $this->option)
                ->overlay($tele, 'bottom left')
                ->text('BHSec', $this->option2)
                ->overlay($bhs, 'top right')
                ->text('Did you know?', $this->option4)
                ->overlay($fb, 'bottom left', 1, 280)
                ->text('BHSecOfficial', $this->option3)
                ->toFile($result, $mime, $quality);

            $return = [
                'Exif' => $image->getExif(),
                'Orientation' => $image->getOrientation(),
                'Resolution' => $image->getResolution(),
                'AspectRatio' => $image->getAspectRatio()
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
