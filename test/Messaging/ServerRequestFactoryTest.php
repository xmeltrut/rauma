<?php

namespace Rauma\Test\Messaging;

use Rauma\Messaging\ServerRequestFactory;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

class ServerRequestFactoryTest extends TestCase
{
    public function testFromGlobals()
    {
        $request = ServerRequestFactory::fromGlobals();

        $this->assertInstanceOf(
            ServerRequest::class,
            $request
        );
    }
}
