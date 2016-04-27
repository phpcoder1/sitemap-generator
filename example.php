<?php

use Phpcoder1\SitemapGenerator\Video\Generator AS VideoSitemapGenerator;
use Phpcoder1\SitemapGenerator\Video\VideoPlayerLoc;
use Phpcoder1\SitemapGenerator\Video\VideoGalleryLoc;
use Phpcoder1\SitemapGenerator\Video\VideoPlatform;
use Phpcoder1\SitemapGenerator\Video\VideoPrice;
use Phpcoder1\SitemapGenerator\Video\VideoUploader;
use Phpcoder1\SitemapGenerator\Generator AS Generator;

require_once 'autoload.php';

/*
$Generator = new VideoSitemapGenerator();
$Generator->setLocUrl('http://test.local/test-video-page');
for ($i = 0; $i < 10; $i++) {
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
for ($i = 0; $i < 10; $i++) {
    $Generator->appendRow('http://test.local/page.html', date("Y-m-d H:i"), Generator::CHANGE_FREQ_DAILY, '1');
}
//echo $Generator->getXml();
//$Generator->createXmlFile('xml/test.xml');

$Generator->publishXml();
