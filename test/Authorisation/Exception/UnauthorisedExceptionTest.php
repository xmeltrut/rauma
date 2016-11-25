<?php

namespace Rauma\Test\Authorisation\Exception;

use Rauma\Authorisation\Exception\UnauthorisedException;

class UnauthorisedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new UnauthorisedException;

        $this->assertInstanceOf(
            'Rauma\Authorisation\Exception\UnauthorisedException',
            $exception
        );
    }
}
