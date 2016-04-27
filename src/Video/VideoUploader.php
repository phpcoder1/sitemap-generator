<?php

namespace Phpcoder1\SitemapGenerator\Video;


class VideoUploader
{
    private $content = '';

    /**
     * @var string UploaderUrl
     */
    private $info = '';

    function __construct($content){
        $this->content = $content;
    }

    public function setInfo($info){
        $this->info = $info;
    }

    public function getInfo(){
        return $this->info;
    }

    public function getContent(){
        return $this->content;
    }
}