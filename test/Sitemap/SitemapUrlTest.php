<?php

namespace Rauma\Test\Sitemap;

use Rauma\Sitemap\SitemapUrl;

class SitemapUrlTest extends \PHPUnit_Framework_TestCase
{
    public function testAccessors()
    {
        $annotation = $this->getMockBuilder('Rauma\Framework\Annotation\Sitemap')
                           ->disableOriginalConstructor()
                           ->getMock();

        $annotation->method('getChangeFreq')->willReturn('daily');
        $annotation->method('getPriority')->willReturn(0.5);

        $url = new SitemapUrl('/test');

        $this->assertEquals('/test', $url->getLocation());
        $this->assertEquals('daily', $url->getChangeFreq());
        $this->assertEquals(0.5, $url->getPriority());
    }
}
