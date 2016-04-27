<?php

namespace Phpcoder1\SitemapGenerator\Video;

class Generator {
    const VERSION = '1.0';
    const ENCODING = 'UTF-8';

    const URL_SET = 'urlset';
    const LOC = 'loc';
    const URL = 'url';
    const MAX_ROWS = 50000;
    const XMLNS_URL = 'http://www.w3.org/2000/xmlns/';
    const SITE_MAPS_ORG_URL = 'http://www.sitemaps.org/schemas/sitemap/0.9';
    const SITE_MAPS_G_URL = 'http://www.google.com/schemas/sitemap-video/1.1';

    const REQUIRES_SUBSCRIPTION_YES = 'yes';
    const REQUIRES_SUBSCRIPTION_NO = 'no';

    const LIVE_YES = 'yes';
    const LIVE_NO = 'no';

    private $doc;
    private $url;
    private $rowsCount;

    function __construct($version = self::VERSION, $encoding = self::ENCODING){
        $this->rowsCount = 0;
        $this->doc = new \DOMDocument($version, $encoding);
    }

    /**
     * @param $url
     */
    public function setLocUrl($url){
        $urlSet = $this->doc->appendChild($this->doc->createElement(self::URL_SET));
        $urlSet->setAttributeNS(self::XMLNS_URL, 'xmlns', self::SITE_MAPS_ORG_URL);
        $urlSet->setAttributeNS(self::XMLNS_URL, 'xmlns:video', self::SITE_MAPS_G_URL);

        $this->url = $urlSet->appendChild($this->doc->createElement(self::URL));
        $this->url->appendChild($this->doc->createElement(self::LOC, $url));
    }

    /**
     * Functaion: appendRow
     *
     * Append new video node
     *
     * @param $thumbnailLoc
     * @param $title
     * @param $description
     * @param $url
     * @param VideoPlayerLoc $videoPlayerLoc
     * @param $duration
     * @param null $tag
     * @param null $expirationDate
     * @param null $rating
     * @param null $viewCount
     * @param null $publicationDate
     * @param null $familyFriendly
     * @param null $category
     * @param null $restriction
     * @param VideoGalleryLoc $videoGalleryLoc
     * @param VideoPrice $videoPrice
     * @param null $requiresSubscription yes|no
     * @param VideoUploader $videoUploader
     * @param VideoPlatform $videoPlatform
     * @param null $live yes|no
     */
    public function appendRow(
        $thumbnailLoc,
        $title,
        $description,
        $url,
        VideoPlayerLoc $videoPlayerLoc,
        $duration,
        $tag = null,
        $expirationDate = null,
        $rating = null,
        $viewCount = null,
        $publicationDate = null,
        $familyFriendly = null,
        $category = null,
        $restriction = null,
        VideoGalleryLoc $videoGalleryLoc = null,
        VideoPrice $videoPrice = null,
        $requiresSubscription = null,
        VideoUploader $videoUploader = null,
        VideoPlatform $videoPlatform = null,
        $live = null
    ){
        if($this->rowsControl() === false){
            return;
        }

        $video = $this->doc->createElement('video:video');
        $video->appendChild($this->doc->createElement('video:thumbnail_loc', $thumbnailLoc));
        $video->appendChild($this->doc->createElement('video:title', $title));
        $video->appendChild($this->doc->createElement('video:description', $description));
        $video->appendChild($this->doc->createElement('video:content_loc', $url));

        $playerLoc = $this->doc->createElement('video:player_loc', $videoPlayerLoc->getContent());
        $playerLoc->setAttribute('allow_embed', $videoPlayerLoc->getAllowEmbed());
        $playerLoc->setAttribute('autoplay', $videoPlayerLoc->getAutoPlay());
        $video->appendChild($playerLoc);

        $video->appendChild($this->doc->createElement('video:duration', $duration));

        if($tag !== null){
            $video->appendChild($this->doc->createElement('video:tag', $tag));
        }

        if($expirationDate !== null){
            $video->appendChild($this->doc->createElement('video:expiration_date', $expirationDate));
        }

        if($rating !== null){
            $video->appendChild($this->doc->createElement('video:rating', $rating));
        }

        if($viewCount !== null){
            $video->appendChild($this->doc->createElement('video:view_count', $viewCount));
        }

        if($publicationDate !== null){
            $video->appendChild($this->doc->createElement('video:publication_date', $publicationDate));
        }

        if($familyFriendly !== null){
            $video->appendChild($this->doc->createElement('video:family_friendly', $familyFriendly));
        }

        if($category !== null){
            $video->appendChild($this->doc->createElement('video:category', $category));
        }

        if($restriction !== null){
            $video->appendChild($this->doc->createElement('video:restriction', $restriction));
        }

        if($videoPrice !== null){
            $galleryLoc = $this->doc->createElement('video:price', $videoPrice->getContent());
            $galleryLoc->setAttribute('currency', $videoPrice->getCurrency());
            $video->appendChild($galleryLoc);
        }

        if($videoGalleryLoc !== null){
            $galleryLoc = $this->doc->createElement('video:gallery_loc', $videoGalleryLoc->getContent());
            $galleryLoc->setAttribute('title', $videoGalleryLoc->getTitle());
            $video->appendChild($galleryLoc);
        }

        if($requiresSubscription !== null) {
            if(in_array($requiresSubscription, array('yes','no'))){
                $video->appendChild($this->doc->createElement('video:requires_subscription', $requiresSubscription));
            }
        }

        if($videoUploader !== null){
            $uploader = $this->doc->createElement('video:uploader', $videoUploader->getContent());
            $uploader->setAttribute('info', $videoUploader->getInfo());
            $video->appendChild($uploader);
        }

        if($live !== null) {
            if(in_array($live, array('yes','no'))){
                $video->appendChild($this->doc->createElement('video:live', $live));
            }
        }

        if($videoPlatform !== null){
            $platform = $this->doc->createElement('video:uploader', $videoPlatform->getContent());
            if(in_array($videoPlatform->getRelationship(), array('allow','deny'))) {
                $platform->setAttribute('relationship', $videoPlatform->getRelationship());
            }
            $video->appendChild($platform);
        }

        $this->url->appendChild($video);
        $this->rowsCount++;
    }

    /**
     * @return true|false rowsCount equals to max rows return false
     */
    public function rowsControl(){
        if($this->rowsCount === self::MAX_ROWS){
            false;
        }else{
            true;
        }
    }

    /**
     * @return string XML
     */
    public function getXml(){
        return $this->doc->saveXML();
    }

    /**
     * @param $filePath
     * @return int|false
     */
    public function createXmlFile($filePath){
        return $this->doc->save($filePath);
    }

    public function publishXml(){
        header('Content-type: application/xml');
        echo $this->getXml();
    }
}