<?php

namespace Rauma\Messaging;

use Zend\Diactoros\ServerRequest as ZendServerRequest;

/**
 * Superclass of the Zend Diactoros ServerRequest object.
 */
class ServerRequest extends ZendServerRequest
{
    /**
     * Retrieve a query parameter.
     *
     * @param string $key          Key.
     * @param mixed  $defaultValue Default value.
     * @return mixed
     */
    public function query($key, $defaultValue = null)
    {
        $queryParams = $this->getQueryParams();

        if (isset($queryParams[$key])) {
            return $queryParams[$key];
        }

        return $defaultValue;
    }
}
