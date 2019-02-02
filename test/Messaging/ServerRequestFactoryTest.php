<?php

namespace Rauma\Test\Messaging;

use Rauma\Messaging\ServerRequestFactory;
use PHPUnit\Framework\TestCase;

class ServerRequestFactoryTest extends TestCase
{
    public function testFromGlobals()
    {
        $request = ServerRequestFactory::fromGlobals();

        $this->assertInstanceOf(
            'Rauma\Messaging\ServerRequest',
            $request
        );
    }
}
