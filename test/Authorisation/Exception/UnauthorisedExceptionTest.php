<?php

namespace Rauma\Test\Authorisation\Exception;

use Rauma\Authorisation\Exception\UnauthorisedException;
use PHPUnit\Framework\TestCase;

class UnauthorisedExceptionTest extends TestCase
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
