<?php

namespace Phpcoder1\SitemapGenerator\Video;


class VideoPrice
{
    private $content = '';

    /**
     * @var string ISO_4217 https://en.wikipedia.org/wiki/ISO_4217
     */
    private $currency = '';

    function __construct($content){
        $this->content = $content;
    }

    /**
     * @param $currency ISO_4217 https://en.wikipedia.org/wiki/ISO_4217
     */

    public function setCurrency($currency){
        $this->currency = $currency;
    }

    public function getCurrency(){
        return $this->currency;
    }

    public function getContent(){
        return $this->content;
    }
}