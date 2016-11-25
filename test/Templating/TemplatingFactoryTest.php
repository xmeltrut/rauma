<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\TemplatingFactory;

class TemplatingFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $templating = TemplatingFactory::create('');

        $this->assertInstanceOf(
            'Rauma\Templating\Templating',
            $templating
        );
    }
}
