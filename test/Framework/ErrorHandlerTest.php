<?php

namespace Rauma\Test\Framework;

use Rauma\Framework\ErrorHandler;
use PHPUnit\Framework\TestCase;

class ErrorHandlerTest extends TestCase
{
    public function tearDown(): void
    {
        restore_error_handler();
    }

    public function testRegister()
    {
        $di = $this->createMock('Rauma\Service\Container');
        $request = $this->createMock('Psr\Http\Message\ServerRequestInterface');
        $controller = $this->getMockBuilder('Rauma\Framework\Controller\ExceptionController')->disableOriginalConstructor()->getMock();

        ErrorHandler::register($di, $request, $controller);

        // #WorstTestEver
        $this->assertTrue(true);
    }
}
