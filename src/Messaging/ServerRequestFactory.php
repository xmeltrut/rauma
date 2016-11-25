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
    public static function fromGlobals(
        array $server = null,
        array $query = null,
        array $body = null,
        array $cookies = null,
        array $files = null
    ) {
        $server  = static::normalizeServer($server ?: $_SERVER);
        $files   = static::normalizeFiles($files ?: $_FILES);
        $headers = static::marshalHeaders($server);

        return new ServerRequest(
            $server,
            $files,
            static::marshalUriFromServer($server, $headers),
            static::get('REQUEST_METHOD', $server, 'GET'),
            'php://input',
            $headers,
            $cookies ?: $_COOKIE,
            $query ?: $_GET,
            $body ?: $_POST
        );
    }
}
