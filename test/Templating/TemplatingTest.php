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

        $templating = new Templating('', $engineMock);
        $result = $templating->render('page.html', ['a' => 'b']);

        $this->assertEquals('html', $result);
    }
}
