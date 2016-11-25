<?php

namespace Rauma\Test\Authorisation;

use Rauma\Authorisation\AuthorisationFactory;

class AuthorisationFactoryTest extends \PHPUnit_Framework_TestCase
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
