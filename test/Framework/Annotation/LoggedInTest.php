<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\LoggedIn;
use PHPUnit\Framework\TestCase;

class LoggedInTest extends TestCase
{
    public function testClass()
    {
        $annotation = new LoggedIn;
        $this->assertInstanceOf('Rauma\Framework\Annotation\LoggedIn', $annotation);
    }
}
