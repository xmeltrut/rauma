<?php

namespace Rauma\Test\Authorisation;

use Rauma\Authorisation\Authorisation;
use Rauma\Authorisation\AuthorisationManager;
use Rauma\Authorisation\Exception\ForbiddenException;
use Rauma\Authorisation\Exception\UnauthorisedException;
use PHPUnit\Framework\TestCase;

class AuthorisationManagerTest extends TestCase
{
    public function testValidateRoute()
    {
        $auth = $this->getMockBuilder(Authorisation::class)
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

    public function testValidateRouteUnauthorised()
    {
        $this->expectException(UnauthorisedException::class);

        $auth = $this->getMockBuilder(Authorisation::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $auth->method('isLoggedIn')->willReturn(false);

        $auth = new AuthorisationManager($auth);

        $auth->validateRoute(['required' => true]);
    }

    public function testValidateRouteForbidden()
    {
        $this->expectException(ForbiddenException::class);

        $auth = $this->getMockBuilder(Authorisation::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $auth->method('isLoggedIn')->willReturn(true);
        $auth->method('hasRole')->willReturn(false);

        $auth = new AuthorisationManager($auth);

        $auth->validateRoute(['allowed' => ['Admin']]);
    }
}
