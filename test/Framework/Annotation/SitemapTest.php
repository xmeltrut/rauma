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
    }

    public function testAttributes()
    {
        $annotation = new Sitemap(['changefreq' => 'daily']);
        $this->assertEquals('daily', $annotation->getChangeFreq());
    }

    /**
     * @expectedException Rauma\Framework\Annotation\Exception\AnnotationException
     */
    public function testInvalidChangeFreq()
    {
        $annotation = new Sitemap(['changefreq' => 'made-up']);
        $annotation->getChangeFreq();
    }
}
