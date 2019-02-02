<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\Allowed;
use PHPUnit\Framework\TestCase;

class AllowedTest extends TestCase
{
    public function testGetRoles()
    {
        $annotation = new Allowed(['value' => 'User,Admin']);
        $this->assertEquals(['User', 'Admin'], $annotation->getRoles());
    }
}
