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
        $annotation->method('getGenerator')->willReturn('methodName');

        $url = new SitemapUrl('/test', $annotation);

        $this->assertEquals('/test', $url->getLocation());
        $this->assertEquals('daily', $url->getChangeFreq());
        $this->assertEquals(0.5, $url->getPriority());
        $this->assertEquals('methodName', $url->getGenerator());
    }

    /**
     * @expectedException Rauma\Framework\Annotation\Exception\AnnotationException
     */
    public function testTokens()
    {
        $annotation = $this->getMockBuilder('Rauma\Framework\Annotation\Sitemap')
                           ->disableOriginalConstructor()
                           ->getMock();

        $url = new SitemapUrl('/test', $annotation, ['test-token']);
    }
}
