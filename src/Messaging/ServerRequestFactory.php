<?php

namespace Rauma\Messaging;

use Zend\Diactoros\ServerRequestFactory as ZendServerRequestFactory;

/**
 * Easily create server request objects.
 */
class ServerRequestFactory extends ZendServerRequestFactory
{
    /**
     * Create a server request from global variables.
     *
     * @return ServerRequest
     */
    public static function fromGlobals()
    {
        $server  = static::normalizeServer($_SERVER);
        $files   = static::normalizeFiles($_FILES);
        $headers = static::marshalHeaders($server);

        return new ServerRequest(
            $server,
            $files,
            static::marshalUriFromServer($server, $headers),
            static::get('REQUEST_METHOD', $server, 'GET'),
            'php://input',
            $headers,
            $_COOKIE,
            $_GET,
            $_POST
        );
    }
}
