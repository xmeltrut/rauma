<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\Meta;
use PHPUnit\Framework\TestCase;

class MetaTest extends TestCase
{
    public function testTitle()
    {
        $meta = new Meta;

        $meta->setTitle('Test');
        $this->assertEquals('Test', $meta->getTitle());

        $meta->setTitle('Sub');
        $this->assertEquals('Sub - Test', $meta->getTitle());

        $meta->setTitle('New', true);
        $this->assertEquals('New', $meta->getTitle());
    }

    public function testKeywords()
    {
        $meta = new Meta;

        $meta->addKeywords(['a', 'b']);
        $this->assertEquals('a,b', $meta->getKeywords());

        $meta->setKeywords(['c', 'd']);
        $this->assertEquals('c,d', $meta->getKeywords());
    }

    public function testDescription()
    {
        $meta = new Meta;

        $meta->setDescription('Test description');
        $this->assertEquals('Test description', $meta->getDescription());
    }

    public function testCanonical()
    {
        $meta = new Meta;

        $meta->setCanonical('test.url');
        $this->assertEquals('test.url', $meta->getCanonical());
    }

    public function testOpenGraph()
    {
        $meta = new Meta;

        $meta->setOgTitle('test og');
        $this->assertEquals('test og', $meta->getOgTitle());

        $meta->setOgImage('og-image');
        $this->assertEquals('og-image', $meta->getOgImage());
    }
}
