<?php

namespace Bhsec\SimpleImage\Templates;

abstract class Templates
{
    public const SOURCE = __DIR__ . '/../../assets/';
    public static function getContainer()
    {
        $container = new \Pimple\Container();
        $container['image'] = $container->factory(function () {
            return new \claviska\SimpleImage();
        });

        $container['query'] = 'dark';
        $container['unsplash'] = function ($c) {
            return new \Bhsec\SimpleImage\Unsplash($c['query']);
        };

        $container['client'] = function()
        {
            return new \GuzzleHttp\Client();
        };

        $container['unsplash_regular'] = function($c)
        {
            $response = $c['client']->request('GET', $c['unsplash']->regular);
            return $response->getBody();
        };

        $container['unsplash_small'] = function($c)
        {
            $response = $c['client']->request('GET', $c['unsplash']->small);
            return $response->getBody();
        };

        $container['unsplash_thumb'] = function($c)
        {
            $response = $c['client']->request('GET', $c['unsplash']->thumb);
            return $response->getBody();
        };

        $container['unsplash_raw'] = function($c)
        {
            $response = $c['client']->request('GET', $c['unsplash']->raw);
            return $response->getBody();
        };

        $container['unsplash_full'] = function($c)
        {
            $response = $c['client']->request('GET', $c['unsplash']->full);
            return $response->getBody();
        };

        return $container;
    }
    public static function filterParagraf(string $paragraf, int $wrap): string
    {
        $paragraf = trim($paragraf);
        $paragraf = mb_substr($paragraf, 0, 301, 'UTF-8');
        $paragraf = str_replace('. ', ".\n", $paragraf);
        $paragraf = wordwrap($paragraf, $wrap, "\n");
        $paragraf = ucwords(strtolower($paragraf));
        return $paragraf;
    }
    public static function make(array $option): array
    {
    }
}
