<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\Meta;

class MetaTest extends \PHPUnit_Framework_TestCase
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

    public function testDescription()
    {
        $meta = new Meta;

        $meta->setDescription('Test description');
        $this->assertEquals('Test description', $meta->getDescription());
    }

    public function testCanonicalUrl()
    {
        $meta = new Meta;

        $meta->setCanonicalUrl('test.url');
        $this->assertEquals('test.url', $meta->getCanonicalUrl());
    }
}
