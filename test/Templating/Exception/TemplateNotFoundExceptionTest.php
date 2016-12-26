<?php

namespace Rauma\Test\Templating\Exception;

use Rauma\Templating\Exception\TemplateNotFoundException;

class TemplateNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new TemplateNotFoundException('test.html');
        $this->assertContains('test.html', $exception->getMessage());
    }
}