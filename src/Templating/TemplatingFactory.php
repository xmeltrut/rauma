<?php

namespace Rauma\Templating;

use Mustache_Engine;

class TemplatingFactory
{
    /**
     * Create a template engine.
     *
     * @param string $appPath Filepath.
     * @param array  $config  Config.
     * @return Templating
     */
    public static function create($appPath, array $config = [])
    {
        $fileLoader = new FileLoader(__DIR__ . '/../../templates');

        if (isset($config['directory'])) {
            $fileLoader->addDirectory($config['directory']);
        } elseif (is_dir($appPath . '/templates')) {
            $fileLoader->addDirectory($config['directory']);
        }

        $engine = new Mustache_Engine([
            'loader' => $fileLoader,
            'partials_loader' => $fileLoader
        ]);

        return new Templating($engine);
    }
}
