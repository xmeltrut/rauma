<?php

namespace Rauma\Test\Common;

use Rauma\Common\Collection;
use PHPUnit\Framework\TestCase;

class COllectionTest extends TestCase
{
    public function testCollection()
    {
        $collection = new Collection(['a' => 1, 'b' => 2]);
        $collection['c'] = 3;

        $this->assertEquals(1, $collection['a']);
        $this->assertEquals(2, $collection['b']);
        $this->assertEquals(3, $collection['c']);
        $this->assertEquals(null, $collection['d']);
        $this->assertEquals(true, isset($collection['a']));
        $this->assertEquals(false, isset($collection['e']));

        unset($collection['a']);

        $this->assertEquals(false, isset($collection['a']));
    }
}
