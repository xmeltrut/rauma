<?php

namespace Rauma\Framework\Config\Exception;

class ParseException extends \Exception
{
    /**
     * Constructor.
     *
     * @param string $message Message from parse error.
     */
    public function __construct($message)
    {
        $this->message = sprintf('Unable to parse config file: %s', $message);
    }
}
