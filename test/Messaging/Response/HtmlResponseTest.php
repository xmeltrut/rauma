<?php

namespace Rauma\Test\Messaging\Response;

use Rauma\Messaging\Response\HtmlResponse;
use PHPUnit\Framework\TestCase;

class HtmlResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new HtmlResponse('<p>Hello, World!</p>');
        $this->assertInstanceOf('Rauma\Messaging\Response\HtmlResponse', $response);
    }
}
