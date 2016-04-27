<?php

namespace Phpcoder1\SitemapGenerator;


class Generator
{
    const VERSION = '1.0';
    const ENCODING = 'UTF-8';

    const URL_SET = 'urlset';
    const LOC = 'loc';
    const URL = 'url';
    const MAX_ROWS = 50000;
    const XMLNS_URL = 'http://www.w3.org/2000/xmlns/';
    const SITE_MAPS_ORG_URL = 'http://www.sitemaps.org/schemas/sitemap/0.9';
    const LAST_MOD = 'lastmod';
    const CHANGE_FREQ = 'changefreq';
    const PRIORITY = 'priority';

    const CHANGE_FREQ_ALWAYS = 'always';
    const CHANGE_FREQ_HOURLY = 'hourly';
    const CHANGE_FREQ_DAILY = 'daily';
    const CHANGE_FREQ_WEEKLY = 'weekly';
    const CHANGE_FREQ_MONTHLY = 'monthly';
    const CHANGE_FREQ_YEARLY = 'yearly';
    const CHANGE_FREQ_NEWER = 'never';

    private $doc;
    private $urlSet;
    private $rowsCount;

    function __construct($version = self::VERSION, $encoding = self::ENCODING)
    {
        $this->rowsCount = 0;
        $this->doc = new \DOMDocument($version, $encoding);

        $this->urlSet = $this->doc->appendChild($this->doc->createElement(self::URL_SET));
        $this->urlSet->setAttributeNS(self::XMLNS_URL, 'xmlns', self::SITE_MAPS_ORG_URL);
    }

    public function appendRow($loc, $lastMod, $changeFreq, $priority){
        $url = $this->doc->createElement(self::URL);

        $url->appendChild($this->doc->createElement(self::LOC, $loc));
        $url->appendChild($this->doc->createElement(self::LAST_MOD, $lastMod));
        $url->appendChild($this->doc->createElement(self::CHANGE_FREQ, $changeFreq));
        $url->appendChild($this->doc->createElement(self::PRIORITY, $priority));
        $this->urlSet->appendChild($url);
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