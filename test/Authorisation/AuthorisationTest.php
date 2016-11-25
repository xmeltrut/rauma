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

    public function testHasPassword()
    {
        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        
        $auth = new Authorisation($session);
        $password = $auth->hashPassword('password123');

        $this->assertInternalType('string', $password);
        $this->assertNotEquals('password123', $password);
    }
}
