<?php

namespace Rauma\Test\Framework;

use Rauma\Framework\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testSendBody()
    {
        $this->expectOutputString('html-body');

        $message = $this->getMockBuilder('Laminas\Diactoros\Response')
                        ->disableOriginalConstructor()
                        ->getMock();

        $message->expects($this->once())
                ->method('getBody')
                ->willReturn('html-body');

        $response = new Response($message);
        $response->sendBody();
    }
}
