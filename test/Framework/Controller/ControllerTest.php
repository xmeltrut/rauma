<?php

namespace Rauma\Test\Framework\Controller;

use Rauma\Test\Bootstrap\ConcreteController;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    private $di;
    private $request;
    private $controller;

    public function setUp()
    {
        $this->di = $this->getMock('Rauma\Service\Container');
        $this->request = $this->getMock('Psr\Http\Message\ServerRequestInterface');

        $this->controller = new ConcreteController($this->di, $this->request);
    }

    public function testServices()
    {
        $this->di->expects($this->once())
                 ->method('get')
                 ->with('db')
                 ->willReturn('DB-SERVICE');

        $service = $this->controller->utService('db');

        $this->assertEquals('DB-SERVICE', $service);
    }

    public function testRequestHelpers()
    {
        $this->request->expects($this->once())->method('getMethod')->willReturn('POST');

        $this->assertSame($this->request, $this->controller->utGetRequest());
        $this->assertEquals(true, $this->controller->utIsPost());
    }

    public function testGetQueryData()
    {
        $this->request->expects($this->once())->method('getQueryParams')->willReturn([
            'c' => 'd'
        ]);

        $collection = $this->controller->utGetQuery();

        $this->assertInstanceOf('Rauma\Common\Collection', $collection);
        $this->assertEquals('d', $collection['c']);
    }

    public function testGetPostData()
    {
        $this->request->expects($this->once())->method('getParsedBody')->willReturn([
            'a' => 'b'
        ]);

        $collection = $this->controller->utGetPost();

        $this->assertInstanceOf('Rauma\Common\Collection', $collection);
        $this->assertEquals('b', $collection['a']);
    }

    public function testGetJson()
    {
        $body = $this->getMockBuilder('Zend\Diactoros\PhpInputStream')
                     ->disableOriginalConstructor()
                     ->getMock();
        $body->method('getContents')->willReturn('{"a":"b"}');

        $this->request->expects($this->once())->method('getBody')->willReturn($body);

        $object = $this->controller->utGetJson();

        $this->assertInstanceOf('\stdClass', $object);
        $this->assertEquals('b', $object->a);
    }
}
