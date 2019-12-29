<?php
namespace Bhsec\SimpleImage;

class Gambar
{
<<<<<<< HEAD
    protected $src = __DIR__ . '/assets';
    protected $option = array();
    protected $option2 = array();
    protected $option3 = array();
    protected $option4 = array();
=======
    protected $src = __DIR__ . '/../assets';
>>>>>>> 04e8eddb9062fc3d29949b0699ee9ddc07f47238
    protected $text;
    protected $query;

    function __construct(
        $text = 'hajigur',
        $query = 'random',
        $font = 'FSEX300.ttf'
    )
    {
        $this->option = [
            // main text
            'color' => 'white',
            'size' => 100,
            'anchor' => 'center',
            'fontFile' => $this->src . '/' . $font,
            'shadow' => [
                // shadow option
                'x' => 15,
                'y' => 15,
                'color' => 'black'
            ]
        ];

        $this->option2 = [
            // bottom text 1
            'color' => 'white',
            'size' => 50,
            'anchor' => 'bottom left',
            'fontFile' => $this->src . '/' . $font,
            'xOffset' => 100
        ];

        $this->option3 = [
            // bottom text 2
            'color' => 'white',
            'size' => 50,
            'anchor' => 'bottom left',
            'xOffset' => 405,
            'fontFile' => $this->src . '/' . $font
        ];

        $this->option4 = [
            // top text 1
            'color' => 'white',
            'size' => 50,
            'anchor' => 'top right',
            'xOffset' => -300,
            'yOffset' => 140,
            'fontFile' => $this->src . '/' . $font
        ];

        $this->text = $text;
        $this->query = $query;
    }

    private function filterParagraf($paragraf, $wrap)
    {
        $paragraf = trim($paragraf);
        $paragraf = str_replace('. ', ".\n\n", $paragraf);
        $paragraf = wordwrap($paragraf, $wrap, "\n");
        $paragraf = ucwords(strtolower($paragraf));
        return $paragraf;
    }

    public function getResult($result, $mime, $quality)
    {
        try {
            $tele = new \claviska\SimpleImage();
            $fb = new \claviska\SimpleImage();
            $bhs = new \claviska\SimpleImage();
            $image = new \claviska\SimpleImage();
            $unsplash = new \Bhsec\SimpleImage\Unsplash($this->query);

            $tele->fromFile($this->src . '/telegram.png')->resize(70, 70);

            $fb->fromFile($this->src . '/facebook.png')->resize(90, 80);

            $bhs->fromFile($this->src . '/bhs.png')->resize(300, 300);

            $image
                ->fromString(file_get_contents($unsplash->result_regular))
                ->resolution(320, 200)
                ->resize(2016, 2016)
                ->autoOrient()
                ->text(self::filterParagraf($this->text, 40), $this->option)
                ->overlay($tele, 'bottom left')
                ->text('BHSec', $this->option2)
                ->overlay($bhs, 'top right', 0.45)
                ->text('Did you know?', $this->option4)
                ->overlay($fb, 'bottom left', 1, 280)
                ->text('BlackHoleSecurity', $this->option3)
                ->toFile($result, $mime, $quality);

            $return = [
                'Exif' => $image->getExif(),
                'Orientation' => $image->getOrientation(),
                'Resolution' => $image->getResolution(),
                'AspectRatio' => $image->getAspectRatio()
            ];

<<<<<<< HEAD
            return json_encode(
                $return,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
=======
            return json_encode($return, JSON_PRETTY_PRINT);
>>>>>>> 04e8eddb9062fc3d29949b0699ee9ddc07f47238
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
