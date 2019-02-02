<?php

namespace Rauma\Test\Messaging\Response;

use Rauma\Messaging\Response\RedirectResponse;

class RedirectResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $response = new RedirectResponse('https://github.com/');
        $this->assertInstanceOf('Rauma\Messaging\Response\RedirectResponse', $response);
    }
}
