<?php

namespace Rauma\Test\Framework\Config\Exception;

use Rauma\Framework\Config\Exception\ParseException;

class ParseExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new ParseException('Unknown error');
        $this->assertContains('Unknown error', $exception->getMessage());
    }
}
