<?php

namespace Rauma\Test\Bootstrap;

class MockServiceFactory
{
    /**
     * Create a mock service object.
     *
     * @param string $value Value to pass through.
     * @return MockService
     */
    public static function create($value = 'C')
    {
        return new MockService($value);
    }
}
