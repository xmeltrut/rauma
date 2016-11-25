<?php

namespace Rauma\Test\Messaging;

use Rauma\Messaging\ServerRequestFactory;

class ServerRequestFactoryTest extends \PHPUnit_Framework_TestCase
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
