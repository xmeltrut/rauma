<?php

namespace Rauma\Test\Framework;

use Rauma\Framework\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testSendBody()
    {
        $this->expectOutputString('html-body');

        $message = $this->getMockBuilder('Zend\Diactoros\Response')
                        ->disableOriginalConstructor()
                        ->getMock();

        $message->expects($this->once())
                ->method('getBody')
                ->willReturn('html-body');

        $response = new Response($message);
        $response->sendBody();
    }
}
