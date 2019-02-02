<?php

namespace Rauma\Test\Framework\Controller;

use Rauma\Test\Bootstrap\ConcretePageController;
use Rauma\Test\Bootstrap\TemplatingQueue;
use PHPUnit\Framework\TestCase;

class PageControllerTest extends TestCase
{
    private $di;
    private $request;
    private $templating;
    private $controller;

    public function setUp()
    {
        $this->di = $this->createMock('Rauma\Service\Container');
        $this->request = $this->createMock('Psr\Http\Message\ServerRequestInterface');
        $this->controller = new ConcretePageController($this->di, $this->request);
    }

    public function testRender()
    {
        $this->templating = $this->getMockBuilder('Rauma\Templating\Templating')
                                 ->disableOriginalConstructor()
                                 ->getMock();

        $this->templating->expects($this->once())
                         ->method('render')
                         ->with('template.html', ['a' => 'b'])
                         ->willReturn('html-content');

        $this->di->method('get')
                 ->with('templating')
                 ->willReturn($this->templating);

        $response = $this->controller->utRender('template.html', ['a' => 'b'], 301);

        $this->assertInstanceOf('Zend\Diactoros\Response\HtmlResponse', $response);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals('html-content', $response->getBody());
    }

    public function testRenderPage()
    {
        $templating = new TemplatingQueue;

        $this->di->method('get')
                 ->with('templating')
                 ->willReturn($templating);

        $response = $this->controller->utRenderPage(
            'template.html',
            ['a' => 'b'],
            ['c' => 'd'],
            300
        );

        $this->assertInstanceOf('Zend\Diactoros\Response\HtmlResponse', $response);
        $this->assertEquals(300, $response->getStatusCode());
        $this->assertEquals('html-content', $response->getBody());

        $firstCall = $templating->shift();

        $this->assertEquals(['template.html', ['a' => 'b']], $firstCall);

        $secondCall = $templating->shift();

        $this->assertEquals('layout.html', $secondCall[0]);
        $this->assertEquals('html-content', $secondCall[1]['body']);
    }
}
