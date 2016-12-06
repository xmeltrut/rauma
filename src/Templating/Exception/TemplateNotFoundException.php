<?php

namespace Rauma\Templating\Exception;

class TemplateNotFoundException extends \Exception
{
    /**
     * Constructor.
     *
     * @param string $name Template name.
     */
    public function __construct($name)
    {
        $this->message = sprintf('Unable to locate template: %s', $name);
    }
}
