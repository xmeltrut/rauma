<?php

namespace Rauma\Templating;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

/**
 * Facade for the Mustache template engine.
 */
class Templating
{
    protected $engine;
    
    /**
     * Create engine.
     *
     * @param string $directory Directory containing the template files.
     */
    public function __construct($directory)
    {
        $this->engine = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader($directory, ['extension' => '']),
            'partials_loader' => new Mustache_Loader_FilesystemLoader($directory, ['extension' => ''])
        ]);
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
