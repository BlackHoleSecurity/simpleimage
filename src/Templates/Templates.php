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
        $container['unsplash'] = function ($c) {
            return new \Bhsec\SimpleImage\Unsplash($c['query']);
        };
        return $container;
    }
    public static function filterParagraf(string $paragraf, string $wrap)
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
