<?php

namespace Rauma\Service;

use ReflectionClass;

class Container
{
    /**
     * Holds array of services already created.
     *
     * @var array
     */
    private $services = [];

    /**
     * Maps the configuration for services.
     *
     * @var array
     */
    private $defaults = [];

    /**
     * Is a service registered?
     *
     * @param string $key Service name.
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->services[$key]) || isset($this->defaults[$key]);
    }

    /**
     * Get a service.
     *
     * @param string $key Service name.
     * @return object
     */
    public function get($key)
    {
        if (!isset($this->services[$key])) {
            $this->initialise($key);
        }

        return (isset($this->services[$key])) ? $this->services[$key] : null;
    }

    /**
     * Register a service.
     *
     * @param string $key    Service name.
     * @param string $class  Class name.
     * @param array  $params Arguments to pass into constructor.
     * @return void
     */
    public function register($key, $class, array $params = [])
    {
        $this->defaults[$key] = [
            'class' => $class,
            'params' => $params
        ];
    }

    /**
     * Register a service.
     *
     * @param string $key     Key.
     * @param object $service Service object.
     * @return void
     */
    public function set($key, $service)
    {
        $this->services[$key] = $service;
    }

    /**
     * Attempt to initialise a service.
     *
     * @param string $key Service name.
     * @return void
     */
    private function initialise($key)
    {
        if (isset($this->defaults[$key])) {
            $default = $this->defaults[$key]['class'];

            if (strpos($default, '::') === false) {
                $reflector = new ReflectionClass($default);

                $this->services[$key] = $reflector->newInstanceArgs(
                    $this->prepareParams($key)
                );
            } else {
                $factory = explode('::', $default);

                $this->services[$key] = call_user_func_array(
                    [$factory[0], $factory[1]],
                    $this->prepareParams($key)
                );
            }
        }
    }

    /**
     * Take a list of params and prepare them for instanciating a service.
     *
     * @param string $key Service name.
     * @return array
     */
    private function prepareParams($key)
    {
        $params = $this->defaults[$key]['params'];

        foreach ($params as $index => $param) {
            if (is_string($param) && preg_match('/^\%(.+)\%$/', $param, $matches)) {
                $params[$index] = $this->get($matches[1]);
            }
        }

        return $params;
    }
}
