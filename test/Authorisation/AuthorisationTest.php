<?php

namespace Rauma\Test\Authorisation;

use Rauma\Authorisation\Authorisation;
use PHPUnit\Framework\TestCase;

class AuthorisationTest extends TestCase
{
    public function testAuthoriserUser()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(4))->method('set');
        $segment->method('get')->willReturn(true);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);
        $session->expects($this->once())->method('regenerateId');

        $auth = new Authorisation($session);
        $auth->authoriseUser(100);

        $this->assertSame(true, $auth->isLoggedIn());
    }

    public function testDeauthoriseUser()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(1))->method('clear');
        $segment->method('get')->willReturn(false);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);
        $auth->deauthoriseUser();

        $this->assertSame(false, $auth->isLoggedIn());
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

    public function testAttributes()
    {
        $segment = $this->getMockBuilder('Aura\\Session\\Segment')
                        ->disableOriginalConstructor()
                        ->getMock();
        $segment->expects($this->exactly(2))->method('get')->with('attributes')->willReturn(['test' => 10]);

        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();
        $session->method('getSegment')->willReturn($segment);

        $auth = new Authorisation($session);

        $this->assertEquals(10, $auth->getAttribute('test'));
        $this->assertEquals(null, $auth->getAttribute('not-there'));
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

    public function testVerifyBlankPasswords()
    {
        $session = $this->getMockBuilder('Aura\\Session\\Session')
                        ->disableOriginalConstructor()
                        ->getMock();

        $auth = new Authorisation($session);

        $this->assertEquals(false, $auth->verifyPassword(null, 'password'));
        $this->assertEquals(false, $auth->verifyPassword('hash', ''));
    }
}
