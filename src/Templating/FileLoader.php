<?php

namespace Rauma\Templating;

use Mustache_Loader;

class FileLoader implements Mustache_Loader
{
    /**
     * @var array Directories to search through.
     */
    private $directories = [];

    /**
     * @var array Template cache
     */
    private $templates = [];

    /**
     * Constructor.
     *
     * @param string $directory Directory path.
     */
    public function __construct($directory)
    {
        $this->addDirectory($directory);
    }

    /**
     * Add a directory to load templates from.
     *
     * @param string $path Directory path.
     * @return void
     */
    public function addDirectory($path)
    {
        if (strpos($path, '://') === false) {
            $path = realpath($path);
        }

        if (!is_dir($path)) {
            throw new Exception\RuntimeException(
                sprintf('Invalid template directory: %s', $path)
            );
        }

        $this->directories[] = $path;
    }

    /**
     * Load a template.
     *
     * @param string $name Template name.
     * @return string
     */
    public function load($name)
    {
        if (!isset($this->templates[$name])) {
            $this->templates[$name] = $this->loadFile($name);
        }

        return $this->templates[$name];
    }

    /**
     * Load a file.
     *
     * @param string $name Template name.
     * @return string
     */
    private function loadFile($name)
    {
        foreach (array_reverse($this->directories) as $directory) {
            $path = sprintf('%s/%s', $directory, $name);

            if (file_exists($path)) {
                return file_get_contents($path);
            }
        }

        throw new Exception\TemplateNotFoundException($name);
    }

    /**
     * Check if a template file exists.
     *
     * @param string $name Template name.
     * @return boolean
     */
    public function exists($name)
    {
        foreach (array_reverse($this->directories) as $directory) {
            $path = sprintf('%s/%s', $directory, $name);

            if (file_exists($path)) {
                return true;
            }
        }

        return false;
    }
}
