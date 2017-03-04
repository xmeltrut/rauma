<?php

namespace Rauma\Test\Framework;

use Rauma\Framework\ErrorHandler;

class ErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        restore_error_handler();
    }

    public function testRegister()
    {
        $di = $this->getMock('Rauma\Service\Container');
        $request = $this->getMock('Psr\Http\Message\ServerRequestInterface');
        $controller = $this->getMockBuilder('Rauma\Framework\Controller\ExceptionController')->disableOriginalConstructor()->getMock();

        ErrorHandler::register($di, $request, $controller);
    }
}
