<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\LoggedIn;

class LoggedInTest extends \PHPUnit_Framework_TestCase
{
    public function testClass()
    {
        $annotation = new LoggedIn;
        $this->assertInstanceOf('Rauma\Framework\Annotation\LoggedIn', $annotation);
    }
}
