<?php

namespace Rauma\Test\Framework\Annotation\Exception;

use Rauma\Framework\Annotation\Exception\AnnotationException;

class AnnotationExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new AnnotationException;

        $this->assertInstanceOf(
            'Rauma\Framework\Annotation\Exception\AnnotationException',
            $exception
        );
    }
}
