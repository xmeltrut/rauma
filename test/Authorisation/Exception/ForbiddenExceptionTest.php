<?php

namespace Rauma\Test\Authorisation\Exception;

use Rauma\Authorisation\Exception\ForbiddenException;
use PHPUnit\Framework\TestCase;

class ForbiddenExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new ForbiddenException;

        $this->assertInstanceOf(
            'Rauma\Authorisation\Exception\ForbiddenException',
            $exception
        );
    }
}
