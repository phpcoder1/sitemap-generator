<?php

namespace Sitemap\Video;


class VideoPlayerLoc
{
    private $content = '';
    private $allowEmbed = 'yes';
    private $autoPlay = 'autoPlay=true';

    function __construct($content){
        $this->content = $content;
    }

    public function setAllowEmbed($allowEmbed){
        $this->allowEmbed = $allowEmbed;
    }

    public function setAutoPlay($autoPlay){
        $this->autoPlay = $autoPlay;
    }

    public function getAllowEmbed(){
        return $this->allowEmbed;
    }

    public function getAutoPlay(){
        return $this->autoPlay;
    }

    public function getContent(){
        return $this->content;
    }
}