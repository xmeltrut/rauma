<?php

namespace Rauma\Test\Templating\Exception;

use Rauma\Templating\Exception\RuntimeException;
use PHPUnit\Framework\TestCase;

class RuntimeExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new RuntimeException;

        $this->assertInstanceOf(
            'Rauma\Templating\Exception\RuntimeException',
            $exception
        );
    }
}
