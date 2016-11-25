<?php

namespace Rauma\Test\Framework\Exception;

use Rauma\Framework\Exception\NotFoundException;

class NotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new NotFoundException;

        $this->assertInstanceOf(
            'Rauma\Framework\Exception\NotFoundException',
            $exception
        );
    }
}
