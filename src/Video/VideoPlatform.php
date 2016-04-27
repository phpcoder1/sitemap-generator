<?php

namespace Phpcoder1\SitemapGenerator\Video;


class VideoPlatform
{
    const RELATION_SHIP_DENY = 'deny';
    const RELATION_SHIP_ALLOW = 'allow';

    const CONTENT_WEB = 'WEB';
    const CONTENT_MOBILE = 'MOBILE';
    const CONTENT_TV = 'TV';

    private $content = '';

    /**
     * @var string allow|deny
     */
    private $relationship = '';

    /**
     * @param $content WEB, MOBILE, TV
     */
    function __construct($content){
        $this->content = $content;
    }

    /**
     * @param $relationship allow|deny
     */
    public function setRelationship($relationship){
        $this->relationship = $relationship;
    }

    public function getRelationship(){
        return $this->relationship;
    }

    public function getContent(){
        return $this->content;
    }
}