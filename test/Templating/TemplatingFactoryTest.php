<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\TemplatingFactory;
use PHPUnit\Framework\TestCase;

class TemplatingFactoryTest extends TestCase
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
