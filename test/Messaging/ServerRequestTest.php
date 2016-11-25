<?php

namespace Rauma\Test\Messaging;

use Rauma\Messaging\ServerRequest;

class ServerRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testFromGlobals()
    {
        $request = new ServerRequest(
            [],
            [],
            null,
            null,
            'php://input',
            [],
            [],
            ['a' => 'b']
        );

        $this->assertEquals('b', $request->query('a'));
        $this->assertEquals(null, $request->query('b'));
        $this->assertEquals('c', $request->query('b', 'c'));
    }
}
