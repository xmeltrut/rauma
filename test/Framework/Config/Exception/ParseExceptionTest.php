<?php

namespace Rauma\Test\Framework\Config\Exception;

use Rauma\Framework\Config\Exception\ParseException;
use PHPUnit\Framework\TestCase;

class ParseExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new ParseException('Unknown error');

        $this->assertStringContainsString(
            'Unknown error',
            $exception->getMessage()
        );
    }
}
