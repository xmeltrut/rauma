<?php

namespace Rauma\Test\Sitemap;

use Rauma\Sitemap\SitemapUrl;

class SitemapUrlTest extends \PHPUnit_Framework_TestCase
{
    public function testAccessors()
    {
        $url = new SitemapUrl('/test');
        $this->assertEquals('/test', $url->getLocation());
    }
}
