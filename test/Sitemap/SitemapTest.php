<?php

namespace Rauma\Test\Sitemap;

use Rauma\Sitemap\Sitemap;
use PHPUnit\Framework\TestCase;

class SitemapTest extends TestCase
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
