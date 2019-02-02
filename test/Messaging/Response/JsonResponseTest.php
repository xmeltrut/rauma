<?php

namespace Rauma\Test\Messaging\Response;

use Rauma\Messaging\Response\JsonResponse;

class JsonResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $response = new JsonResponse(['a' => 'b']);
        $this->assertInstanceOf('Rauma\Messaging\Response\JsonResponse', $response);
    }
}
