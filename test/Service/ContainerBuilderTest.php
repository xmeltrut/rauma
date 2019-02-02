<?php

namespace Rauma\Test\Service;

use Rauma\Service\ContainerBuilder;
use PHPUnit\Framework\TestCase;

class ContainerBuilderTest extends TestCase
{
    public function testCreate()
    {
        $di = ContainerBuilder::create([
            'test1' => 'TestClass',
            'test2' => ['class' => 'TestClass', 'params' => ['param1']]
        ]);

        $this->assertInstanceOf(
            'Rauma\Service\Container',
            $di
        );
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidConfig()
    {
        $di = ContainerBuilder::create([
            'test' => ['params' => ['param1']]
        ]);
    }
}
