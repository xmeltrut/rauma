<?php

namespace Rauma\Test\Sitemap;

use Rauma\Sitemap\SitemapUrl;
use PHPUnit\Framework\TestCase;

class SitemapUrlTest extends TestCase
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
