<?php

namespace Rauma\Test\Authorisation;

use Rauma\Authorisation\Authorisation;

class AuthorisationTest extends \PHPUnit_Framework_TestCase
{
    public function testAuthoriserUser()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(4))->method('set');

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);
        $session->expects($this->once())->method('regenerateId');

        $auth = new Authorisation($session);
        $auth->authoriseUser(100, 'Test McTest');
    }

    public function testDeauthoriseUser()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(1))->method('clear');

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);
        $auth->deauthoriseUser();
    }

    public function testGetId()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(1))->method('get')->with('id');

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);
        $auth->getId();
    }

    public function testGetDescription()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(1))->method('get')->with('description');

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);
        $auth->getDescription();
    }

    public function testHasRole()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(2))->method('get')->with('roles')->willReturn(['role1']);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);
        
        $this->assertEquals(true, $auth->hasRole('role1'));
        $this->assertEquals(false, $auth->hasRole('role2'));
    }

    public function testHashAndVerifyPassword()
    {
        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        
        $auth = new Authorisation($session);
        $hash = $auth->hashPassword('password123');

        $this->assertInternalType('string', $hash);
        $this->assertNotEquals('password123', $hash);

        $this->assertEquals(true, $auth->verifyPassword($hash, 'password123'));
        $this->assertEquals(false, $auth->verifyPassword($hash, 'different-pass'));
    }

    public function testValidateRoute()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->method('get')->will($this->returnCallback(function($param) {
            switch ($param) {
                case 'authorised':
                    return 1;
                case 'roles':
                    return ['Admin'];
            }
        }));
        //$segment->expects($this->once())->method('get')->with('authorised')->willReturn(1);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);

        $this->assertEquals(true, $auth->validateRoute([
            'required' => true,
            'allowed' => ['Admin']
        ]));
    }

    /**
     * @expectedException \Rauma\Authorisation\Exception\UnauthorisedException
     */
    public function testValidateRouteUnauthorised()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->once())->method('get')->with('authorised')->willReturn(false);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);

        $auth->validateRoute(['required' => true]);
    }

    /**
     * @expectedException \Rauma\Authorisation\Exception\ForbiddenException
     */
    public function testValidateRouteForbidden()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->once())->method('get')->with('roles')->willReturn(['User']);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);

        $auth->validateRoute(['allowed' => ['Admin']]);
    }
}
