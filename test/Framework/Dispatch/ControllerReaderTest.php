<?php

namespace Rauma\Framework\Dispatch;

use Rauma\Framework\Dispatch\ControllerReader;
use PHPUnit\Framework\TestCase;

class ControllerReaderTest extends TestCase
{
    private $reader;
    private $cr;

    public function setUp()
    {
        $this->reader = $this->getMockBuilder('Doctrine\Common\Annotations\Reader')
                             ->disableOriginalConstructor()
                             ->getMock();
    }

    public function testRead()
    {
        $classAnnotation = $this->createMock('Rauma\Framework\Annotation\LoggedIn');

        $routeAnnotation = $this->getMockBuilder('Rauma\Framework\Annotation\Route')
                                ->disableOriginalConstructor()
                                ->getMock();
        $routeAnnotation->method('getVerb')->willReturn('GET');
        $routeAnnotation->method('getPath')->willReturn('/test-route');
        $routeAnnotation->method('generateName')->willReturn('generated.name');
        $routeAnnotation->method('getAdditionalVerbs')->willReturn(['HEAD']);
        $routeAnnotation->method('getTokens')->willReturn([]);

        $this->reader->expects($this->once())
                     ->method('getClassAnnotations')
                     ->willReturn([$classAnnotation]);

        $this->reader->expects($this->once())
                     ->method('getMethodAnnotations')
                     ->willReturn([$routeAnnotation]);

        $cr = new ControllerReader(
            $this->reader,
            'Rauma\Test\Bootstrap\AnnotatedController'
        );

        $routes = $cr->readRoutes();

        $this->assertEquals([[
            'controller' => 'Rauma\Test\Bootstrap\AnnotatedController',
            'method' => 'testRoute',
            'verb' => 'GET',
            'name' => 'generated.name',
            'path' => '/test-route',
            'additionalVerbs' => ['HEAD'],
            'tokens' => [],
            'auth' => ['required' => true]
        ]], $routes);
    }
}
