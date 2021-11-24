<?php

namespace Rauma\Test\Templating\Exception;

use Rauma\Templating\Exception\TemplateNotFoundException;
use PHPUnit\Framework\TestCase;

class TemplateNotFoundExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new TemplateNotFoundException('test.html');

        $this->assertStringContainsString(
            'test.html',
            $exception->getMessage()
        );
    }
}