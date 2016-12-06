<?php

namespace Rauma\Test\Templating\Exception;

use Rauma\Templating\Exception\RuntimeException;

class RuntimeExceptionTest extends \PHPUnit_Framework_TestCase
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
