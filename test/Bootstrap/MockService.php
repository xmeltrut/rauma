<?php

namespace Rauma\Test\Bootstrap;

/**
 * We use this for testing the service container.
 */
class MockService
{
    private $value;

    /**
     * Constructor.
     *
     * @param string $value Example value.
     */
    public function __construct($value = 'A')
    {
        $this->value = $value;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
