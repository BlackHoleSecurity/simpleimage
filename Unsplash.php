<?php
class Unsplash
{
    protected $access_unsplash = '';
    protected $secret_unsplash = '';
    protected $page = 1;
    protected $per_page = 1;
    protected $orientation = 'landscape';// 'portrait';
    public $result_full;
    public $result_regular;
    public $result_small;
    public $result_thumb;
    public $result_raw;

    function __construct($query)
    {
        Crew\Unsplash\HttpClient::init(
            [
                'applicationId' => $this->access_unsplash,
                'secret' => $this->secret_unsplash,
                'utmSource' => 'simpleimage'
            ]
        );

        $result = Crew\Unsplash\Search::photos($query, $this->page, $this->per_page, $this->orientation);
        $index=0;
        $this->result_full = $result[$index]['urls']['full'];
        $this->result_regular = $result[$index]['urls']['regular'];
        $this->result_small = $result[$index]['urls']['small'];
        $this->result_thumb = $result[$index]['urls']['thumb'];
        $this->result_raw = $result[$index]['urls']['raw'];
    }
}
