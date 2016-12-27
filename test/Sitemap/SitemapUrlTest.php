<?php

namespace Rauma\Test\Sitemap;

use Rauma\Sitemap\SitemapUrl;

class SitemapUrlTest extends \PHPUnit_Framework_TestCase
{
    public function testAccessors()
    {
        $url = new SitemapUrl('/test', 0.6);

        $this->assertEquals('/test', $url->getLocation());
        $this->assertEquals(0.6, $url->getPriority());
    }

    public function testDefaultPriority()
    {
        $url = new SitemapUrl('/test');

        $this->assertEquals(0.5, $url->getPriority());
    }
}
