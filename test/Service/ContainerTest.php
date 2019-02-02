<?php

namespace Rauma\Test\Service;

use Rauma\Service\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function testSet()
    {
        $mockService = new \StdClass;
        $di = new Container;

        $this->assertEquals(null, $di->get('test'));

        $di->set('test', $mockService);

        $this->assertEquals($mockService, $di->get('test'));
    }

    public function testInitialise()
    {
        $di = new Container;
        $di->register('test', 'Rauma\Test\Bootstrap\MockService');
        $mockService = $di->get('test');

        $this->assertInstanceOf('Rauma\Test\Bootstrap\MockService', $mockService);
        $this->assertEquals('A', $mockService->getValue());
        $this->assertSame($mockService, $di->get('test'));
    }

    public function testInitialiseWithParams()
    {
        $di = new Container;
        $di->register('test', 'Rauma\Test\Bootstrap\MockService', ['B']);
        $mockService = $di->get('test');

        $this->assertEquals('B', $mockService->getValue());
    }

    public function testInitialiseWithFactory()
    {
        $di = new Container;
        $di->register('test', 'Rauma\Test\Bootstrap\MockServiceFactory::create', ['D']);
        $mockService = $di->get('test');

        $this->assertInstanceOf('Rauma\Test\Bootstrap\MockService', $mockService);
        $this->assertEquals('D', $mockService->getValue());
        $this->assertSame($mockService, $di->get('test'));
    }

    public function testInitialiseWithDependency()
    {
        $di = new Container;
        $di->register('dependency', 'Rauma\Test\Bootstrap\MockDependency');
        $di->register('test', 'Rauma\Test\Bootstrap\MockService', ['%dependency%']);
        $mockService = $di->get('test');

        $this->assertInstanceOf('Rauma\Test\Bootstrap\MockService', $mockService);
        $this->assertInstanceOf('Rauma\Test\Bootstrap\MockDependency', $mockService->getValue());
    }
}
