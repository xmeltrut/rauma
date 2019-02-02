<?php

namespace Rauma\Test\Authorisation;

use Rauma\Authorisation\AuthorisationManager;
use PHPUnit\Framework\TestCase;

class AuthorisationManagerTest extends TestCase
{
    public function testValidateRoute()
    {
        $auth = $this->getMockBuilder('Rauma\Authorisation\Authorisation')
                     ->disableOriginalConstructor()
                     ->getMock();

        $auth->method('isLoggedIn')->willReturn(true);
        $auth->method('hasRole')->willReturn(true);

        $auth = new AuthorisationManager($auth);

        $this->assertSame(true, $auth->validateRoute([
            'required' => true,
            'allowed' => ['Admin']
        ]));
    }

    /**
     * @expectedException \Rauma\Authorisation\Exception\UnauthorisedException
     */
    public function testValidateRouteUnauthorised()
    {
        $auth = $this->getMockBuilder('Rauma\Authorisation\Authorisation')
                     ->disableOriginalConstructor()
                     ->getMock();

        $auth->method('isLoggedIn')->willReturn(false);

        $auth = new AuthorisationManager($auth);

        $auth->validateRoute(['required' => true]);
    }

    /**
     * @expectedException \Rauma\Authorisation\Exception\ForbiddenException
     */
    public function testValidateRouteForbidden()
    {
        $auth = $this->getMockBuilder('Rauma\Authorisation\Authorisation')
                     ->disableOriginalConstructor()
                     ->getMock();

        $auth->method('isLoggedIn')->willReturn(true);
        $auth->method('hasRole')->willReturn(false);

        $auth = new AuthorisationManager($auth);

        $auth->validateRoute(['allowed' => ['Admin']]);
    }
}
