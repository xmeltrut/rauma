<?php

namespace Rauma\Templating;

use Mustache_Engine;

/**
 * Facade for the Mustache template engine.
 */
class Templating
{
    protected $engine;
    
    /**
     * Create engine.
     *
     * @param Mustache_Engine $engine Mustache engine.
     */
    public function __construct(Mustache_Engine $engine)
    {
        $this->engine = $engine;
    }
    
    /**
     * Render a template.
     *
     * @param string $template Template file.
     * @param array  $data     Template data.
     * @return string
     */
    public function render($template, array $data = [])
    {
        return $this->engine->render($template, $data);
    }
}
