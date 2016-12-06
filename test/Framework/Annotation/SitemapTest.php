<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\Sitemap;

class SitemapTest extends \PHPUnit_Framework_TestCase
{
    public function testClass()
    {
        $annotation = new Sitemap;

        $this->assertInstanceOf(
            'Rauma\Framework\Annotation\Sitemap',
            $annotation
        );
        $this->assertEquals(null, $annotation->getChangeFreq());
        $this->assertEquals(0.5, $annotation->getPriority());
    }

    public function testAttributes()
    {
        $annotation = new Sitemap([
            'changefreq' => 'daily'
            'priority' => '0.7'
        ]);

        $this->assertEquals('daily', $annotation->getChangeFreq());
        $this->assertEquals(0.7, $annotation->getPriority());
    }

    /**
     * @expectedException Rauma\Framework\Annotation\Exception\AnnotationException
     */
    public function testInvalidChangeFreq()
    {
        $annotation = new Sitemap(['changefreq' => 'made-up']);
        $annotation->getChangeFreq();
    }

    /**
     * @expectedException Rauma\Framework\Annotation\Exception\AnnotationException
     */
    public function testInvalidPriority()
    {
        $annotation = new Sitemap(['priority' => '1.1']);
        $annotation->getPriority();
    }
}
