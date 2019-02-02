<?php

namespace Rauma\Test\Framework\Exception;

use Rauma\Framework\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class NotFoundExceptionTest extends TestCase
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
