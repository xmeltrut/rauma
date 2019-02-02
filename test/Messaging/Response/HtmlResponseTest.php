<?php

namespace Rauma\Test\Messaging\Response;

use Rauma\Messaging\Response\HtmlResponse;

class HtmlResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $response = new HtmlResponse('<p>Hello, World!</p>');
        $this->assertInstanceOf('Rauma\Messaging\Response\HtmlResponse', $response);
    }
}
