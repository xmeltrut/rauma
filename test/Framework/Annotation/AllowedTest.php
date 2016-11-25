<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\Allowed;

class AllowedTest extends \PHPUnit_Framework_TestCase
{
    public function testGetRoles()
    {
        $annotation = new Allowed(['value' => 'User,Admin']);
        $this->assertEquals(['User', 'Admin'], $annotation->getRoles());
    }
}
