<?php

namespace Phpcoder1\SitemapGenerator\Video;


class VideoGalleryLoc {
    private $content = '';
    private $title = '';

    function __construct($content){
        $this->content = $content;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getContent(){
        return $this->content;
    }
}