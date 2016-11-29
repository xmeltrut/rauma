<?php

namespace Rauma\Test\Framework\Controller;

use Rauma\Framework\Controller\ExceptionController;
use Exception;

class ExceptionControllerTest extends \PHPUnit_Framework_TestCase
{
    private $di;
    private $request;
    private $templating;
    private $controller;

    public function setUp()
    {
        $this->di = $this->getMock('Rauma\Service\Container');
        $this->request = $this->getMock('Psr\Http\Message\ServerRequestInterface');
        $this->controller = new ExceptionController($this->di, $this->request);

        $this->templating = $this->getMockBuilder('Rauma\Templating\Templating')
                                 ->disableOriginalConstructor()
                                 ->getMock();

        $this->di->method('get')
                 ->with('templating')
                 ->willReturn($this->templating);
    }

    /**
     * @runInSeparateProcess
     * @expectedException Exception
     */
    public function testErrorDisplayErrors()
    {
        putenv('app.display_errors=1');

        $response = $this->controller->error(new Exception);
    }

    public function testError()
    {
        $this->templating->expects($this->exactly(2))
                         ->method('render')
                         ->willReturn('html-content');

        $response = $this->controller->error(new Exception);

        $this->assertInstanceOf('Zend\Diactoros\Response\HtmlResponse', $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('html-content', $response->getBody());
    }

    public function testForbidden()
    {
        $this->templating->expects($this->exactly(2))
                         ->method('render')
                         ->willReturn('html-content');

        $response = $this->controller->forbidden();

        $this->assertInstanceOf('Zend\Diactoros\Response\HtmlResponse', $response);
        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals('html-content', $response->getBody());
    }

    public function testNotFound()
    {
        $this->templating->expects($this->exactly(2))
                         ->method('render')
                         ->willReturn('html-content');

        $response = $this->controller->notFound();

        $this->assertInstanceOf('Zend\Diactoros\Response\HtmlResponse', $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('html-content', $response->getBody());
    }

    public function testUnauthorised()
    {
        $uri = $this->getMockBuilder('Zend\Diactoros\Uri')
                    ->disableOriginalConstructor()
                    ->getMock();

        $uri->method('getPath')->willReturn('/test-path');
        $uri->method('getQuery')->willReturn('q=1');

        $this->request->method('getUri')->willReturn($uri);

        $response = $this->controller->unauthorised();

        $this->assertInstanceOf('Zend\Diactoros\Response\RedirectResponse', $response);
        $this->assertEquals(401, $response->getStatusCode());

        $this->assertEquals(
            ['/login?from=%2Ftest-path%3Fq%3D1'],
            $response->getHeader('location')
        );
    }
}
