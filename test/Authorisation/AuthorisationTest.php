<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Authorisation\Authorisation;

class AuthorisationTest extends \PHPUnit_Framework_TestCase
{
    public function testClass()
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
}
