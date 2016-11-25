<?php

namespace Rauma\Test\Common;

use Rauma\Common\Collection;

class COllectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCollection()
    {
        $collection = new Collection(['a' => 1, 'b' => 2]);
        $collection['c'] = 3;

        $this->assertEquals(1, $collection['a']);
        $this->assertEquals(2, $collection['b']);
        $this->assertEquals(3, $collection['c']);
        $this->assertEquals(null, $collection['d']);
    }
}
