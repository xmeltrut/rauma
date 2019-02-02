<?php

namespace Rauma\Test\Authorisation;

use Rauma\Authorisation\AuthorisationFactory;
use PHPUnit\Framework\TestCase;

class AuthorisationFactoryTest extends TestCase
{
    public function testCreate()
    {
        $session = $this->getMockBuilder('Aura\Session\Session')
                        ->disableOriginalConstructor()
                        ->getMock();

        $object = AuthorisationFactory::create($session);

        $this->assertInstanceOf(
            'Rauma\Authorisation\Authorisation',
            $object
        );
    }
}
