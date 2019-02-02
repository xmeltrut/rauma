<?php

namespace Rauma\Test\Messaging\Response;

use Rauma\Messaging\Response\JsonResponse;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new JsonResponse(['a' => 'b']);
        $this->assertInstanceOf('Rauma\Messaging\Response\JsonResponse', $response);
    }
}
