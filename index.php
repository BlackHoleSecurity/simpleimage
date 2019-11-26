<?php
require_once __DIR__.'/vendor/autoload.php';
class Gambar {
    protected $src=__DIR__.'/assets';
    protected $option=array();
    protected $option2=array();
    protected $option3=array();
    protected $text;

    function __construct($text = 'hajigur', $font = 'FSEX300.ttf', $query = 'random')
    {
        $this->option=[ // main text
            'color'    => 'white',
            'size'     => 100,
            'anchor'   => 'center',
            'fontFile' => $this->src.'/'.$font,

            'shadow'=>[ // shadow option
                'x'     => 15,
                'y'     => 15,
                'color' =>'black'
            ]
        ];

        $this->option2=[ // bottom text 1
            'color'    => 'white',
            'size'     => 50,
            'anchor'   => 'bottom left',
            'fontFile' => $this->src.'/'.$font,
            'xOffset'  => 100
        ];

        $this->option3=[ // bottom text 2
            'color'    => 'white',
            'size'     => 50,
            'anchor'   => 'bottom left',
            'xOffset'  => 405,
            'fontFile' => $this->src.'/'.$font
        ];

        $this->option4=[ // top text 1
            'color'    => 'white',
            'size'     => 50,
            'anchor'   => 'top right',
            'xOffset'  => -300,
            'yOffset'  => 140,
            'fontFile' => $this->src.'/'.$font
        ];

        $this->text  = $text;
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
            $tele  = new claviska\SimpleImage();
            $fb    = new claviska\SimpleImage();
            $bhs   = new claviska\SimpleImage();
            $image = new claviska\SimpleImage();

            $tele
                ->fromFile($this->src.'/telegram.png')
                ->resize(70,70);

            $fb
                ->fromFile($this->src.'/facebook.png')
                ->resize(90,80);

            $bhs
                ->fromFile($this->src.'/bhs.png')
                ->resize(300,300);

            $image
                ->fromFile($this->src.'/bg.jpg')
                ->resolution(320, 200)
                ->autoOrient()
                ->text(self::filterParagraf($this->text, 40), $this->option)
                ->overlay($tele,'bottom left')
                ->text('BHSec', $this->option2)
                ->overlay($bhs, 'top right', 0.45)
                ->text('Did you know?', $this->option4)
                ->overlay($fb, 'bottom left', 1, 280)
                ->text('BlackHoleSecurity', $this->option3)
                ->toFile($result, $mime, $quality);
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    //    private function curlSendRequest($url){
    //        $curl = curl_init();
    //        curl_setopt($curl, CURLOPT_URL, $url);
    //        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
    //            'query' => $this->query,
    //            'per_page'=>50,
    //            'client_id'=>$this->key_unsplash
    //        )));
    //        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    //        $result = curl_exec($curl);
    //        curl_close($curl);
    //        return json_decode($result, true);
    //    }
}
try {
    $paragraf="bihun adalah bahasa pemrograman interpretatif multiguna dengan filosofi perancangan yang berfokus pada tingkat keterbacaan kode.";

    $draw = new Gambar($paragraf); //paragraf, font, query
    $draw->getResult('result.png', 'image/png', 100); //result, mime, quality
} catch(Exception $e) {
    echo $e->getMessage()."\n";
}
