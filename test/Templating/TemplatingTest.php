<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\Templating;

class TemplatingTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $engineMock = $this->getMockBuilder('Mustache_Engine')
                           ->disableOriginalConstructor()
                           ->getMock();

        $engineMock->expects($this->once())
                   ->method('render')
                   ->with('page.html', ['a' => 'b'])
                   ->willReturn('html');

        $templating = new Templating($engineMock);
        $result = $templating->render('page.html', ['a' => 'b']);

        $this->assertEquals('html', $result);
    }

    public function testExists()
    {
        $loaderMock = $this->getMockBuilder('Rauma\Templating\FileLoader')
                           ->disableOriginalConstructor()
                           ->getMock();

        $loaderMock->expects($this->once())
                   ->method('exists')
                   ->with('page.html')
                   ->willReturn(true);

        $engineMock = $this->getMockBuilder('Mustache_Engine')
                           ->disableOriginalConstructor()
                           ->getMock();

        $engineMock->expects($this->once())
                   ->method('getLoader')
                   ->willReturn($loaderMock);

        $templating = new Templating($engineMock);
        $result = $templating->exists('page.html');

        $this->assertEquals(true, $result);
    }

    public function testAddHelper()
    {
        $engineMock = $this->getMockBuilder('Mustache_Engine')
                           ->disableOriginalConstructor()
                           ->getMock();

        $engineMock->expects($this->once())
                   ->method('addHelper')
                   ->with('helper-name', ['helpers']);

        $templating = new Templating($engineMock);
        $templating->addHelper('helper-name', ['helpers']);
    }
}
