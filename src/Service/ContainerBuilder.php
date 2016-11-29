<?php

namespace Rauma\Service;

use Exception;

class ContainerBuilder
{
    /**
     * Construct a dependency injection container and configure
     * it with services.
     *
     * @param array $services Service configuration.
     * @return Container
     */
    public static function create(array $services = [])
    {
        $di = new Container;

        foreach ($services as $name => $value) {
            if (is_array($value)) {
                if (!isset($value['class'])) {
                    throw new Exception(sprintf('Class name must be specified for service %s', $name));
                }

                $params = (isset($value['params']) && is_array($value['params'])) ? $value['params'] : [];

                $di->register($name, $value['class'], $params);
            } else {
                $di->register($name, $value);
            }
        }

        return $di;
    }
}
