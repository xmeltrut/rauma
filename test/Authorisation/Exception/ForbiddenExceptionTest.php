<?php

namespace Rauma\Test\Authorisation\Exception;

use Rauma\Authorisation\Exception\ForbiddenException;

class ForbiddenExceptionTest extends \PHPUnit_Framework_TestCase
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
