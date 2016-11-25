<?php

namespace Rauma\Templating;

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
        if (isset($config['directory'])) {
            $directory = $config['directory'];
        } elseif (is_dir($appPath . '/templates')) {
            $directory = $appPath . '/templates';
        } else {
            $directory = __DIR__ . '/../../templates';
        }

        return new Templating($directory);
    }
}
