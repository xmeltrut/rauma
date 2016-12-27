<?php

namespace Rauma\Test\Sitemap;

use Rauma\Sitemap\Sitemap;

class SitemapTest extends \PHPUnit_Framework_TestCase
{
    public function testAddUrl()
    {
        $url = $this->getMockBuilder('Rauma\Sitemap\SitemapUrl')
                    ->disableOriginalConstructor()
                    ->getMock();

        $sitemap = new Sitemap('http://example.com');
        $sitemap->addUrl($url);

        $this->assertEquals('http://example.com', $sitemap->getBaseUrl());
        $this->assertEquals([$url], $sitemap->getUrls());
    }
}
