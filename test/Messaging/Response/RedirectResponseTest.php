<?php

namespace Rauma\Test\Messaging\Response;

use Rauma\Messaging\Response\RedirectResponse;
use PHPUnit\Framework\TestCase;

class RedirectResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new RedirectResponse('https://github.com/');
        $this->assertInstanceOf('Rauma\Messaging\Response\RedirectResponse', $response);
    }
}
