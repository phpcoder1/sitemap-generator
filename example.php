<?php

use Sitemap\Video\Generator AS VideoSitemapGenerator;
use Sitemap\Video\VideoPlayerLoc;
use Sitemap\Video\VideoGalleryLoc;
use Sitemap\Video\VideoPlatform;
use Sitemap\Video\VideoPrice;
use Sitemap\Video\VideoUploader;
use Sitemap\Generator AS Generator;

include_once 'autoload.php';

/*
$Generator = new VideoSitemapGenerator();
$Generator->setLocUrl('http://test.local/test-video-page');
for($i=0; $i<10; $i++) {
    $Generator->appendRow(
        'http://test.local/test.jpg',
        'test', '<test>', 'http://test.local/test.mkv',
        new VideoPlayerLoc('http://test.local/video_player_loc'),
        20,
        'test,test2'
    );
}
*/
$Generator = new Generator();
for($i=0; $i<10; $i++) {
    $Generator->appendRow('http://test.local/page.html', date("Y-m-d H:i"), Generator::CHANGE_FREQ_DAILY, '1');
}
//echo $Generator->getXml();
//$Generator->createXmlFile('xml/test.xml');

$Generator->publishXml();
