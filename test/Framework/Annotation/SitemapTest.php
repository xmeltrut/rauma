<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\Sitemap;

class SitemapTest extends \PHPUnit_Framework_TestCase
{
    public function testClass()
    {
        $annotation = new Sitemap;
        $this->assertInstanceOf('Rauma\Framework\Annotation\Sitemap', $annotation);
    }
}
